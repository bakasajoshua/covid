<?php

namespace App;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

use DB;
use Exception;

class Synch
{

	private static $db_connections = ['nairobi', 'alupe', 'kisumu', 'cpgh'];

	public function quarantine()
	{
		$connections = self::$db_connections;

		foreach ($connections as $key => $value) {
			DB::connection($value)->table('quarantine_sites')->where(['synched' => 0])->get();
			
		}
	}

	public static function synch_to_nphl()
	{
		$samples = CovidSampleView::where('repeatt', 0)
						->whereIn('result', [1,2])
						->where('datedispatched', date('Y-m-d'))
						->with(['lab'])
						->get();

		$a = ['nationalities', 'covid_sample_types', 'covid_symptoms'];
		$lookups = [];
		foreach ($a as $value) {
			$lookups[$value] = DB::table($value)->get();
		}

		foreach ($lookups['covid_symptoms'] as $key => $value) {
			$symptoms_array[$key] = $value;
		}

		$client = new Client(['base_uri' => env('NPHL_URL')]);

		foreach ($samples as $key => $sample) {
			$travelled = 'No';
			$history = '';
			if (!$sample->patient->travel->isEmpty()){
				$travelled = 'Yes';
				foreach ($sample->patient->travel as $key => $travel) {
					$history .= $travel->town->name . ', ' . $travel->town->country . ';';
				}
			}

			$has_symptoms = 'No';
			$symptoms = '';
			if($sample->date_symptoms){
				$has_symptoms = 'Yes';
				foreach ($sample->symptoms as $value) {
					$symptoms .= $symptoms_array[$value] . ';';
				}
			}

			// dd(self::get_token($lab));
			$response = $client->request('post', '', [
				'http_errors' => false,
				'verify' => false,
				'json' => [
					'USERNAME' => env('NPHL_USERNAME'),
					'PASSWORD' => env('NPHL_PASSWORD'),
					'TESTING_LAB' => $sample->lab->nphl_code,

					'CASE_ID' => null,
					'CASE_TYPE' => $sample->sample_type == 1 ? 'Initial' : 'Repeat',
					'SAMPLE_TYPE' => $sample->get_prop_name($lookups['covid_sample_types'], 'sample_type', 'nphl_name'),
					'SAMPLE_NUMBER' => $sample->original_sample_id,
					'SAMPLE_COLLECTION_DATE' => $sample->datecollected,
					'RESULT' => $sample->result_name,
					'LAB_CONFIRMATION_DATE' => $sample->datedispatched,

					'FIRST_FOLLOW_UP_DATE' => null,
					'FIRST_FOLLOW_UP_RESULT' => null,
					'SECOND_FOLLOW_UP_DATE' => null,
					'SECOND_FOLLOW_UP_RESULT' => null,
					'THIRD_FOLLOW_UP_DATE' => null,
					'THIRD_FOLLOW_UP_RESULT' => null,

					'PATIENT_NAMES' => $sample->patient_name,
					'PATIENT_PHONE' => $sample->phone_no,
					'AGE' => $sample->age,
					'AGE_UNIT' => 'Years',
					'GENDER' => substr($sample->gender, 0, 1),
					'OCCUPATION' => $sample->occupation,
					'NATIONALITY' => $sample->get_prop_name($lookups['nationalities'], 'nationality'),
					'NATIONAL_ID' => $sample->national_id ?? $sample->identifier,
					'COUNTY' => $sample->countyname ?? $sample->county,
					'SUB_COUNTY' => $sample->subcountyname ?? $sample->sub_county ?? $sample->subcounty ?? '',
					'WARD' => $sample->residence,
					'VILLAGE' => $sample->residence,

					'HAS_TRAVEL_HISTORY' => $travelled,
					'TRAVEL_FROM' => $history,
					'CONTACT_WITH_CASE' => 'No',
					'CONFIRMED_CASE_NAME' => null,

					'SYMPTOMATIC' => $has_symptoms,
					'SYMPTOMS' => $symptoms,
					'SYMPTOMS_ONSET_DATE' => $sample->date_symptoms,
					'COUNTY_OF_DIAGNOSIS' => $sample->countyname ?? $sample->county,

					'QUARANTINED_FACILITY' => $sample->quarantine_site ?? $sample->facilityname ?? null,
					'HOSPITALIZED' => $sample->date_admission ? 'Yes' : 'Unknown',
					'ADMISSION_DATE' => $sample->date_admission,
				],
			]);

			echo 'Status code ' . $response->getStatusCode() . "\n";

			$body = json_decode($response->getBody());
			dd($body);
			if($response->getStatusCode() < 400){

			}else{
				dd($body);
			}
		}
	}
}
