<?php

namespace App\Http\Controllers;

use App\Covid;
use App\CovidPatient;
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
    public function index($param=0)
    {
        $user = auth()->user();
        $query = CovidSampleView::orderBy('id', 'desc')->when(($user->user_type_id == 3), function($query) use ($user){
                return $query->where('lab_id', $user->lab_id);
            })->when($param, function($query) use($param){
                if($param == 1) return $query->with(['lab'])->where('result', 1);
                else if($param == 2) return $query->with(['lab'])->whereIn('result', [2, 8]);
                return $query->whereNull('receivedstatus');
            })->where('repeatt', 0);
        $paginate = false;

        if($param) $samples = $query->get();
        else{
            $samples = $query->paginate(20);
            $paginate = true;
        }
        $results = DB::table('results')->get();
        $received_statuses = DB::table('receivedstatus')->get();
        $test_types = DB::table('covid_test_types')->get();
        return view('tables.samples', compact('samples', 'results', 'received_statuses', 'test_types', 'paginate', 'param'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Covid::covid_form();
        return view('forms.covidsample', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = Covid::covid_arrays();

        $patient = new CovidPatient;
        $patient->fill($request->only($data['patient']));
        $patient->current_health_status = $request->input('health_status');
        $patient->save();

        $sample = new CovidSample;
        $sample->fill($request->only($data['sample']));
        $sample->patient_id = $patient->id;
        $sample->save();
        return back();
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
        // if($covidSample->result) abort(400);
        $results = DB::table('results')->get();
        $received_statuses = DB::table('receivedstatus')->get();
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
        if($covidSample->result) abort(400);
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
