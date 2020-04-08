<?php

namespace App;

use DB;
use Str;

class Covid
{

    public static function covid_form()
    {
        $tables = ['identifier_types', 'health_statuses', 'covid_justifications', 'covid_test_types', 'covid_symptoms', 'observed_signs', 'underlying_conditions', 'covid_isolations', 'covid_sample_types', 'national_db.viralrejectedreasons', 'national_db.receivedstatus', 'national_db.gender', 'national_db.results', 'national_db.countys'];

        $data = [];

        foreach ($tables as $key => $value) {
            $data[str_replace('national_db.', '', $value)] = DB::table($value)->get();
        }
        return $data;
    }

    public static function covid_arrays()
    {
        return [
            'sample' => ['test_type', 'amrs_location', 'provider_identifier', 'order_no', 'health_status', 'symptoms', 'temperature', 'observed_signs', 'underlying_conditions', 'comments', 'labcomment', 'sample_type', 'receivedstatus', 'rejectedreason', 'datecollected', 'datereceived', 'result'],
            'patient' => ['identifier_type', 'identifier', 'patient_name', 'occupation', 'justification', 'county', 'subcounty', 'ward', 'residence', 'hospital_admitted', 'dob', 'sex', 'date_symptoms', 'date_admission', 'date_isolation', 'date_death', 'facility_id', 'county_id', 'patient_name', 'email_address', 'phone_no', 'contact_email_address', 'contact_phone_no'],
        ];
    }
    
    public static function edit_maps()
    {
    	$counties = DB::table('countys')->get();

    	foreach ($counties as $county) {
    		$name = strtolower($county->name);
    		$name = str_replace(' ', '_', $name);
    		// file_get_contents(public_path('maps/kenya.json'));

    		$county_data = file_get_contents(public_path('maps/counties/' . $name . '.json'));
    		if(!$county_data) echo $name . " not found \n ";
    		else{
		    	$subcounties = DB::table('districts')->get();

		    	$county_data = json_decode($county_data);
		    	// dd($county_data);

		    	foreach ($county_data->data->features as $key => $value) {
		    		$subcounty = DB::table('districts')->where('name', $value->properties->name)->first();

		    		if(!$subcounty) echo "Cannot find " . $value->properties->name . " in county {$name} \n";
		    		else{
		    			$value->properties->OBJECTID = $subcounty->id;
		    			$county_data->data->features[$key] = $value;
		    		}
		    	}

		    	// file_put_contents(file_get_contents(public_path('maps/counties/' . $name . '.json')), $county_data);
    		}
    	}
    }

    public static function dump_reference_tables()
    {
        $tables = ['results', 'receivedstatus', 'covid_sample_types', 'covid_symptoms', 'covid_test_types', 'health_statuses', 'identifier_types', 'observed_signs', 'underlying_conditions', 'nationalities'];

        $data = [];

        foreach ($tables as $key => $value) {
            $data[$value] = DB::table($value)->get();
        }
        $data['labs'] = DB::table('labs')->select('id', 'name')->get();
        file_put_contents(public_path('reference_tables.json'), json_encode($data, JSON_PRETTY_PRINT));
    }
}
