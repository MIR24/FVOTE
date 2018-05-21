<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Kris\LaravelFormBuilder\FormBuilder;
use Kris\LaravelFormBuilder\FormBuilderTrait;

class UserController extends Controller
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
        $layout = 'admin.layouts.app';
        $view = 'admin.datatables.users';

        $user = Auth::user();
        if (!$user->getRoleNames()->contains('admin')) {
            return redirect('/');
        }

        return view(
            $view,
            [
                'layout' => $layout,
                'title' => 'Пользователи'
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
        $builder = User::select(['id', 'created_at', 'updated_at', 'name', 'email', 'status', 'filial', 'note']);
        return Datatables::of($builder)->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $model = User::select(['id', 'name', 'email', 'filial', 'note', 'status'])->findOrFail($id);
        $model->role = $model->getRoleNames()->first();
        $form = $formBuilder->create('App\Forms\UserForm', [
            'method' => 'PUT',
            'url' => route('users.update', [$id]),
            'model' => $model,
        ]);
        $params = [
            'form' => $form,
            'cardHeader' => 'Редактирование Пользователя'
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
        $form = $this->form(\App\Forms\UserForm::class);

        // It will automatically use current request, get the rules, and do the validation
        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        // Or automatically redirect on error. This will throw an HttpResponseException with redirect
        $form->redirectIfNotValid();

        $model = User::findOrFail($id);

        $data = $form->getFieldValues();
        $model->update($data);
        $model->syncRoles([$data['role']]);

        return redirect()->route('users.index');
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
