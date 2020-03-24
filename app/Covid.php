<?php

namespace App;

use DB;
use Str;

class Covid
{
    
    public static function edit_maps()
    {
    	$counties = DB::table('countys')->get();

    	foreach ($counties as $county) {
    		$name = strtolower($county->name);
    		$name = str_replace(' ', '_', $name);
    		file_get_contents(public_path('maps/kenya.json'));

    		$county_data = file_get_contents(public_path('maps/counties/' . $name . '.json'));
    		if(!$county_data) echo $name . " not found \n ";
    		else{
		    	$subcounties = DB::table('districts')->get();

		    	foreach ($county_data->data->features as $key => $value) {
		    		$subcounty = DB::table('districts')->where('name', $value->properties->name)->first();

		    		if(!$subcounty) echo "Cannot find " . $value->properties->name . " in county {$name} \n";
		    		else{
		    			$value->properties->OBJECTID = $subcounty->id;
		    			$county_data->data->features[$key] = $value;
		    		}
		    	}

		    	file_put_contents(file_get_contents(public_path('maps/counties/' . $name . '.json')), $county_data);
    		}
    	}
    }
}
