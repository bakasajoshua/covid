<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CovidConsumptionDetail extends BaseModel
{
    protected $connection = 'nat';    

    protected static function boot()
    {
        parent::boot();
        static::creating(function (Model $model) {
            $model->original_id = $model->count() + 1;
        });
    }
    
    public function kit()
    {
    	return $this->belongsTo(CovidKit::class, 'kit_id', 'id');
    }
}
