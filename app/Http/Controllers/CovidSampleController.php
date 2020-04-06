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
    public function index($pending=false)
    {
        $user = auth()->user();
        $samples = CovidSampleView::orderBy('id', 'desc')->when(($user->user_type_id == 3), function($query) use ($user){
                return $query->where('lab_id', $user->lab_id);
            })->when($pending, function($query){
                return $query->whereNull('receivedstatus');
            })->paginate(20);
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
        $covidSample->fill($request->all());
        $covidSample->save();
        return redirect('covid_sample');
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
