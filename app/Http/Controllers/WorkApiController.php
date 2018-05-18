<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CompetitiveWork;
use App\Nomination;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;

class WorkApiController extends Controller
{
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
        $user = Auth::user();
        $nomination = Nomination::findOrFail($id);
        $builder = $nomination->competitiveWorks()->select('id', 'filial', 'name', 'url', 'correspondent', 'operator');
        return Datatables::of($builder)
            ->addColumn('action', function ($work) use ($id) {
                return '<a href="'.route('workThumbsUp', [$id, $work->id]).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-thumbs-up"></i> Нравится</a>';
            })
            ->setRowClass(function ($work) use ($user) {
                return $user->hasUpVoted($work) ? 'bg-success' : '';
            })
            ->rawColumns(['url', 'action'])
            ->make(true);
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
    public function edit($id)
    {
        //
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
        //
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
