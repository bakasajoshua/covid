<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConsumptionDetailBreakdown extends Model
{
    /**
     * The connection type used for this model
     *
     * @var string
     */
    protected $connection = 'nat';

    /**
     * The attributes that should be guarded from mass assignment.
     *
     * @var array
     */

    protected $guarded = [];

    public function scopeExisting($query, $details_id, $breakdown_id, $breakdown_type)
    {
        return $query->where(['consumption_details_id' => $details_id, 'consumption_breakdown_id' => $breakdown_id, 'consumption_breakdown_type' => $breakdown_type]);
    }

    public function consumption_breakdown() {
        return $this->morphTo();
    }

    public function apisave() {
        $this->synched = 1;
        $this->datesynched = date('Y-m-d');
        $this->save();
    }
}
