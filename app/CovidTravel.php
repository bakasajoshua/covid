<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CovidTravel extends BaseModel
{
	protected $dates = ['travel_date'];

<<<<<<< HEAD
    protected $table = 'covid_travels';

    public function patient()
    {
        return $this->belongsTo(CovidPatient::class, 'patient_id');
    }
    
=======

    public function patient()
    {
        return $this->belongsTo('App\CovidPatient', 'patient_id');
    }


>>>>>>> 4427455c08cd5ef61592ba5aaff3b6a12884fa84
    public function town()
    {
        return $this->belongsTo('App\City', 'city_id');
    }
}
