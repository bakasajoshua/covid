<?php

namespace App;

use DB;

class CovidSampleView extends BaseModel
{
	protected $table = "covid_sample_view";
    // protected $dates = ['datecollected', 'datereceived', 'datetested', 'datedispatched', 'dateapproved', 'dateapproved2'];

    protected $casts = [
        'symptoms' => 'array',
        'observed_signs' => 'array',
        'underlying_conditions' => 'array',     
    ];

    public function lab()
    {
        return $this->belongsTo('App\Lab', 'lab_id');
    }

<<<<<<< HEAD
    public function patient()
    {
        return $this->belongsTo(CovidPatient::class, 'patient_id');
    }

=======
    public function travel()
    {
        return $this->belongsTo('App\CovidTravel', 'sample_id');
    }

    public function patient()
    {
        return $this->belongsTo('App\CovidPatient', 'patient_id');
    }
>>>>>>> 4427455c08cd5ef61592ba5aaff3b6a12884fa84
    
    /**
     * Get the sample's result name
     *
     * @return string
     */
    public function getResultNameAttribute()
    {
        if($this->result == 1){ return "Negative"; }
        else if($this->result == 2){ return "Positive"; }
        else if($this->result == 3){ return "Failed"; }
        else if($this->result == 5){ return "Collect New Sample"; }
        else{ return ""; }
    }

    /**
     * Get the patient's gender
     *
     * @return string
     */
    public function getGenderAttribute()
    {
        if($this->sex == 1){ return "Male"; }
        else if($this->sex == 2){ return "Female"; }
        else{ return "No Gender"; }
    }
    
<<<<<<< HEAD
    
    /**
     * Get the sample's result name
     *
     * @return string
     */
    public function getResultNameAttribute()
    {
        if($this->result == 1){ return "Negative"; }
        else if($this->result == 2){ return "Positive"; }
        else if($this->result == 3){ return "Failed"; }
        else if($this->result == 5){ return "Collect New Sample"; }
        else{ return ""; }
=======
    public function getSampletypeAttribute()
    {
        return DB::table('covid_test_types')->where('id', '=', "{$this->test_type}")->first()->name ?? null;
>>>>>>> 4427455c08cd5ef61592ba5aaff3b6a12884fa84
    }
}
