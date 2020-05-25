<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{

	protected $table = 'facilitys';

    public $timestamps = false;

    public function scopeLocate($query, $param)
    {
    	if(is_numeric($param)) return $query->where('DHIScode', $param);
    	 return $query->where('facilitycode', $param);
    }
}
