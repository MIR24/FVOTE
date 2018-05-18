<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Nomination;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;

class NominationApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
            ->addColumn('votes', function ($nomination) {
                $count = 0;
                foreach ($nomination->competitiveWorks as $work) {
                    $count += $work->countUpVoters();
                }
                return $count;
            })
            ->setRowClass(function ($nomination) use ($user) {
                foreach ($nomination->competitiveWorks as $work) {
                    if ($user->hasUpVoted($work)) {
                        return 'bg-success';
                    }
                }
            })
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
