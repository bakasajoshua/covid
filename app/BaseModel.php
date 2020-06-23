<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at', '_token', '_method', 'kemri_id', 'national_sample_id', 'national_patient_id', 'national_batch_id', 'national_travel_id'];

    public function get_prop_name($coll, $attr, $attr2='name')
    {
        if(!$this->$attr) return '';
        foreach ($coll as $value) {
            if($value->id == $this->$attr) return $value->$attr2;
        }
        return '';
    }
}
