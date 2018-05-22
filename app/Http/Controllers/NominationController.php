<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Nomination;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Kris\LaravelFormBuilder\FormBuilder;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use Carbon\Carbon;

class NominationController extends Controller
{
    use FormBuilderTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $layout = 'user.layouts.app';
        $view = 'user.datatables.nominations';
        $user = Auth::user();
        if ($user->getRoleNames()->contains('admin')) {
            $layout = 'admin.layouts.app';
            $view = 'admin.datatables.nominations';
        }
        return view(
            $view,
            [
                'layout' => $layout,
                'title' => 'Номинации'
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
        $builder = Nomination::select([
            'id',
            'from_time',
            'to_time',
            'name',
            'status'
        ]);
        if (!$user->getRoleNames()->contains('admin')) {
            $builder->where('status', 'active');
        }

        return Datatables::of($builder)
            ->addColumn('votes', function ($model) {
                $count = 0;
                foreach ($model->competitiveWorks as $work) {
                    $count += $work->countUpVoters();
                }
                return $count;
            })
            ->addColumn('action', function ($model) {
                return '<a href="'.route('nominations.edit', [$model->id]).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Редактировать</a>';
            })
            ->setRowClass(function ($model) use ($user) {
                foreach ($model->competitiveWorks as $work) {
                    if ($user->hasUpVoted($work)) {
                        return 'bg-success';
                    }
                }
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create('App\Forms\NominationForm', [
            'method' => 'POST',
            'url' => route('nominations.store')
        ]);

        $params = [
            'form' => $form,
            'cardHeader' => 'Создание Номинации'
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
        $form = $this->form(\App\Forms\NominationForm::class);

        // It will automatically use current request, get the rules, and do the validation
        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        // Or automatically redirect on error. This will throw an HttpResponseException with redirect
        $form->redirectIfNotValid();

        Nomination::create($form->getFieldValues());
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
        $model = Nomination::findOrFail($id);
        Carbon::setToStringFormat('Y-m-d\Th:m:s');
        $form = $formBuilder->create('App\Forms\NominationForm', [
            'method' => 'PUT',
            'url' => route('nominations.update', [$id]),
            'model' => $model,
        ]);

        $params = [
            'form' => $form,
            'cardHeader' => 'Редактирование Номинации'
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
        $form = $this->form(\App\Forms\NominationForm::class);

        // It will automatically use current request, get the rules, and do the validation
        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        // Or automatically redirect on error. This will throw an HttpResponseException with redirect
        $form->redirectIfNotValid();

        $model = Nomination::findOrFail($id);

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
}
