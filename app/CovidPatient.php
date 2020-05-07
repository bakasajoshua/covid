<?php

namespace App;

use DB;

class CovidPatient extends BaseModel
{

	protected $dates = ['dob', 'date_symptoms', 'date_admission', 'date_isolation', 'date_death', 'date_recovered'];

    public function travel()
    {
        return $this->hasMany('App\CovidTravel', 'patient_id');
    }

    public function facility()
    {
        return $this->belongsTo('App\Facility');
    }

    public function sample()
    {
        return $this->hasMany('App\CovidSample', 'patient_id');
    }

    public function setHealthStatusAttribute($value)
    {
        $this->attributes['current_health_status'] = $value;
    }


    public function setSexAttribute($value)
    {
        if(is_numeric($value)) $this->attributes['sex'] = $value;
        else{
            if(str_contains($value, ['F', 'f'])) $this->attributes['sex'] = 2;
            else{
                $this->attributes['sex'] = 1;
            }
        }
    }
}
