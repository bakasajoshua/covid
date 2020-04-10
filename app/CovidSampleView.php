<?php

namespace App;

class CovidSampleView extends BaseModel
{
	protected $table = "covid_sample_view";

    public function lab()
    {
        return $this->belongsTo('App\Lab', 'lab_id');
    }
}
