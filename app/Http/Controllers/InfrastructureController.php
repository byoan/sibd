<?php

namespace App\Http\Controllers;

use App\Infrastructure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Db;

class InfrastructureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->getUser()->hasPermission(['select'], 'infrastructures');

        // Retrieve the full infrastructures list
        $infrastructuresList = DB::connection($this->getUser()->getRole->name)->table('infrastructures')->paginate(20);

        return view('infrastructures.index', array(
            'infrastructures' => $infrastructuresList
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->getUser()->hasPermission(['insert'], 'infrastructures');

        return view('infrastructures.create');
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
     * @param  \App\Infrastructure  $infrastructure
     * @return \Illuminate\Http\Response
     */
    public function show(Infrastructure $infrastructure)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Infrastructure  $infrastructure
     * @return \Illuminate\Http\Response
     */
    public function edit(Infrastructure $infrastructure)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Infrastructure  $infrastructure
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Infrastructure $infrastructure)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Infrastructure  $infrastructure
     * @return \Illuminate\Http\Response
     */
    public function destroy(Infrastructure $infrastructure)
    {
        //
    }
}
