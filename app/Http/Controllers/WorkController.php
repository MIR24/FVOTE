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
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexByNomination($id)
    {
        $layout = 'user.layouts.app';
        $view = 'user.datatables.worksByNomination';
        $user = Auth::user();
        if ($user->getRoleNames()->contains('admin')) {
            $layout = 'admin.layouts.app';
            $view = 'admin.datatables.worksByNomination';
        }
        $nomination = Nomination::find($id);
        return view(
            $view,
            [
                'layout' => $layout,
                'title' => 'Работы в номинации '.$nomination->name,
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
            ->addColumn('action', function ($work) use ($id) {
                return '<a href="'.route('works.thumbsUp', [$id, $work->id]).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-thumbs-up"></i> Нравится</a>';
            })
            ->addColumn('edit', function ($work) {
                return '<a href="'.route('works.edit', [$work->id]).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Редактировать</a>';
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
    public function create(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create('App\Forms\WorkForm', [
            'method' => 'POST',
            'url' => route('works.store')
        ]);

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
        $form = $this->form(\App\Forms\WorkForm::class);

        // It will automatically use current request, get the rules, and do the validation
        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        // Or automatically redirect on error. This will throw an HttpResponseException with redirect
        $form->redirectIfNotValid();

        CompetitiveWork::create($form->getFieldValues());
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
        $form = $formBuilder->create('App\Forms\WorkForm', [
            'method' => 'PUT',
            'url' => route('works.update', [$id]),
            'model' => $model,
        ]);

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
        $form = $this->form(\App\Forms\WorkForm::class);

        // It will automatically use current request, get the rules, and do the validation
        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        // Or automatically redirect on error. This will throw an HttpResponseException with redirect
        $form->redirectIfNotValid();

        $model = CompetitiveWork::findOrFail($id);

        $model->update($form->getFieldValues());

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
