<?php

namespace App\Http\Controllers;

use App\Atts;
use Illuminate\Http\Request;

class AttsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->getUser()->hasPermission(['select'], 'atts');

        // Retrieve the full horse att list
        $attsList = DB::connection($this->getUser()->getRole->name)->table('atts')->paginate(20);
        
        return view('atts.index', array(
            'atts' => $attsList
        ));
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
     * @param  \App\Atts  $atts
     * @return \Illuminate\Http\Response
     */
    public function show(Atts $atts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Atts  $atts
     * @return \Illuminate\Http\Response
     */
    public function edit(Atts $atts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Atts  $atts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Atts $atts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Atts  $atts
     * @return \Illuminate\Http\Response
     */
    public function destroy(Atts $atts)
    {
        //
    }
}
