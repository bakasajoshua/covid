<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CovidConsumption extends BaseModel
{
    protected $connection = 'nat';

    protected static function boot()
    {
        parent::boot();
        static::creating(function (Model $model) {
            $model->original_id = $model->count() + 1;
        });
    }

    public function details()
    {
    	return $this->hasMany(CovidConsumptionDetail::class, 'consumption_id', 'id');
    }

    public function scopeExisting($query, $start_of_week)
    {
        return $query->where(['start_of_week' => $start_of_week]);
    }

    public function lab()
    {
    	return $this->belongsTo(Lab::class, 'lab_id', 'id');
    }

    public function synchComplete()
    {
        foreach ($this->details as $key => $detail) {
            $detail->synced = 1;
            $detail->datesynced = date('Y-m-d');
            $detail->save();
        }
        $this->synced = 1;
        $this->datesynced = date('Y-m-d');
        $this->save();
    }
}
