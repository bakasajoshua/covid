<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CovidTravel extends BaseModel
{
	protected $dates = ['travel_date'];

    public function patient()
    {
        return $this->belongsTo(CovidPatient::class, 'patient_id');
    }
}
