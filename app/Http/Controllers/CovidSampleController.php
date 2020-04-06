<?php

namespace App\Http\Controllers;

use App\CovidSample;
use App\CovidSampleView;
use DB;
use Illuminate\Http\Request;

class CovidSampleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $samples = CovidSampleView::orderBy('id', 'desc')->paginate(20);
        $results = DB::table('national_db.results')->get();
        $received_statuses = DB::table('national_db.receivedstatus')->get();
        return view('tables.samples', compact('samples', 'results', 'received_statuses'));
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
     * @param  \App\CovidSample  $covidSample
     * @return \Illuminate\Http\Response
     */
    public function show(CovidSample $covidSample)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CovidSample  $covidSample
     * @return \Illuminate\Http\Response
     */
    public function edit(CovidSample $covidSample)
    {
        $results = DB::table('national_db.results')->get();
        $received_statuses = DB::table('national_db.receivedstatus')->get();
        return view('forms.sample', compact('covidSample', 'results', 'received_statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CovidSample  $covidSample
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CovidSample $covidSample)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CovidSample  $covidSample
     * @return \Illuminate\Http\Response
     */
    public function destroy(CovidSample $covidSample)
    {
        //
    }
}
