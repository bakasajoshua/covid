<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    

    public function get_prop_name($coll, $attr, $attr2='name')
    {
        if(!$this->$attr) return '';
        foreach ($coll as $value) {
            if($value->id == $this->$attr) return $value->$attr2;
        }
        return '';
    }
}
