<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CovidTravel extends BaseModel
{
	protected $dates = ['travel_date'];

    protected $table = 'covid_travels';

    public function patient()
    {
        return $this->belongsTo(CovidPatient::class, 'patient_id');
    }
}
