<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CompetitiveWork;
use App\Nomination;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Kris\LaravelFormBuilder\FormBuilder;
use Kris\LaravelFormBuilder\FormBuilderTrait;

class WorkController extends Controller
{

    use FormBuilderTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if (!$user->getRoleNames()->contains('admin')) {
            return redirect('/');
        }

        $layout = 'admin.layouts.app';
        $view = 'admin.datatables.works';

        return view(
            $view,
            [
                'layout' => $layout,
                'title' => 'Работы'
            ]
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexDT()
    {
        $user = Auth::user();
        $builder = CompetitiveWork::select([
                    'id',
                    'filial',
                    'name',
                    'url',
                    'correspondent',
                    'operator'
        ]);

        return Datatables::of($builder)
                        ->addColumn('edit', function ($work) {
                            return '<a href="' . route('works.edit', [$work->id]) . '" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Редактировать</a>';
                        })
                        ->editColumn('url', function ($work) {
                            return $work->link;
                        })
                        ->rawColumns(['url', 'action', 'edit'])
                        ->make(true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexByNomination($id)
    {
        $layout = 'user.layouts.appnew';
        $user = Auth::user();
        $nomination = Nomination::find($id);
        $view = config('ntype.view')[$nomination->ntype];
        if ($user->getRoleNames()->contains('admin')) {
            $layout = 'admin.layouts.appnew';
            $view = config('ntype.viewAdmin')[$nomination->ntype];
        }

        return view(
            $view,
            [
                'layout' => $layout,
                'title' => 'Работы в номинации ' . $nomination->name,
                'model' => $nomination
            ]
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexByNominationDT($id)
    {
        $user = Auth::user();
        $nomination = Nomination::findOrFail($id);
        $builder = $nomination->competitiveWorks()->select('id', 'filial', 'name', 'url', 'correspondent', 'operator');
        return Datatables::of($builder)
                        ->addColumn('action', function ($work) use ($id, $user) {
                            return '<a href="' . route('works.thumbsUp', [$id, $work->id]) . '" class="btn  btn-primary">&nbsp;<i class="glyphicon '. ($user->hasUpVoted($work) ? 'glyphicon-thumbs-up' : 'glyphicon-thumbs-down') .'"></i>&nbsp;</a>';
                        })
                        ->addColumn('edit', function ($work) {
                            return '<a href="' . route('works.edit', [$work->id]) . '" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Редактировать</a>';
                        })
                        ->addColumn('votes', function ($work) {
                            return $work->countUpVoters();
                        })
                        ->setRowClass(function ($work) use ($user) {
                            return $user->hasUpVoted($work) ? 'bg-success' : '';
                        })
                        ->editColumn('url', function ($work) {
                            return $work->link;
                        })
                        ->rawColumns(['url', 'action', 'edit'])
                        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($nominationId, FormBuilder $formBuilder)
    {
        $nomination = Nomination::find($nominationId);
        $form = config('ntype.form')[$nomination->ntype];
        $form = $formBuilder->create($form, [
            'method' => 'POST',
            'url' => route('works.store'),
                ], ['nomination' => $nominationId]);

        $params = [
            'form' => $form,
            'cardHeader' => 'Создание Работы'
        ];
        return view('admin.forms.default', $params);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nominationId = $request->input('nomination');

        if (empty($nominationId)) {
            return redirect()->back()->withInput();
        }

        $nomination = Nomination::find($nominationId);

        $formClassName = config('ntype.form')[$nomination->ntype];

        $form = $this->form($formClassName);

        // It will automatically use current request, get the rules, and do the validation
        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        // Or automatically redirect on error. This will throw an HttpResponseException with redirect
        $form->redirectIfNotValid();

        $data = $form->getFieldValues();
        $model = CompetitiveWork::create($data);
        if ($data['nomination'] > 0) {
            $model->nominations()->sync([$data['nomination']]);
        } else {
            $model->nominations()->sync();
        }

        return redirect()->route('nominations.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, FormBuilder $formBuilder)
    {
        $model = CompetitiveWork::findOrFail($id);
        $nomination = $model->nominations->first();
        $form = config('ntype.form')[$nomination->ntype];
        $form = $formBuilder->create($form, [
            'method' => 'PUT',
            'url' => route('works.update', [$id]),
            'model' => $model,
                ], ['nomination' => $nomination->id]);

        $params = [
            'form' => $form,
            'cardHeader' => 'Редактирование Работы'
        ];

        return view('admin.forms.default', $params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $nominationId = $request->input('nomination');

        if (empty($nominationId)) {
            return redirect()->back()->withInput();
        }

        $nomination = Nomination::find($nominationId);

        $formClassName = config('ntype.form')[$nomination->ntype];

        $form = $this->form($formClassName);

        // It will automatically use current request, get the rules, and do the validation
        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        // Or automatically redirect on error. This will throw an HttpResponseException with redirect
        $form->redirectIfNotValid();

        $model = CompetitiveWork::findOrFail($id);

        $data = $form->getFieldValues();
        $model->update($data);
        if ($data['nomination'] > 0) {
            $model->nominations()->sync([$data['nomination']]);
        } else {
            $model->nominations()->sync();
        }

        return redirect()->route('nominations.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function thumbsUp($nId, $wId)
    {
        $nomination = Nomination::find($nId);
        if ($nomination->status !== 'active') {
            return back();
        }
        if (!$nomination->competitiveWorks->contains($wId)) {
            return back();
        }
        $user = Auth::user();
        foreach ($nomination->competitiveWorks as $work) {
            $user->cancelVote($work);
        }
        $work = $nomination->competitiveWorks->first(function ($value, $key) use ($wId) {
            return $value->id == $wId;
        });
        $user->upVote($work);

        return back();
    }
}
