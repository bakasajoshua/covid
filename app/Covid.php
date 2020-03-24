<?php

namespace App;

use DB;
use Str;

class Covid
{
    
    public function edit_maps()
    {
    	$counties = DB::connection('nat')->table('countys')->get();

    	foreach ($counties as $county) {
    		$name = strtolower($county->name);
    		$name = str_replace(' ', '_', $name);
    		file_get_contents(public_path('maps/kenya.json'));

    		$county_data = file_get_contents(public_path('maps/counties/' . $name . '.json'));
    		if(!$county_data) echo $name . " not found \n ";
    	}
    }
}
