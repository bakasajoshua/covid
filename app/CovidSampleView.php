<?php

namespace App;

class CovidSampleView extends BaseModel
{
	protected $table = "covid_sample_view";

    protected $casts = [
        'symptoms' => 'array',
        'observed_signs' => 'array',
        'underlying_conditions' => 'array',     
    ];

    public function lab()
    {
        return $this->belongsTo('App\Lab', 'lab_id');
    }

    public function patient()
    {
        return $this->belongsTo(CovidPatient::class, 'patient_id');
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
}
