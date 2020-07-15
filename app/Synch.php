<?php

namespace App;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;



use App\Mail\KilifiNPHLSamples;
use App\Mail\TestMail;
use DB;
use Exception;

class Synch
{

	private static $db_connections = ['nairobi', 'alupe', 'kisumu', 'cpgh'];

	public static function login($lab)
	{
		Cache::forget($lab->token_name);
		$client = new Client(['base_uri' => $lab->base_url]);
		// dd($lab->base_url);
		try {
			$response = $client->request('post', 'auth/login', [
	            'http_errors' => false,
	            'connect_timeout' => 1.5,
				'headers' => [
					'Accept' => 'application/json',
				],
				'json' => [
					'email' => env('LAB_USERNAME', null),
					'password' => env('LAB_PASSWORD', null),
				],
			]);
			$status_code = $response->getStatusCode();
			// if($status_code > 399) die();
			$body = json_decode($response->getBody());
			// print_r($body);
			Cache::put($lab->token_name, $body->token, 60);	
			// echo $lab->token_name . " is {$body->token} \n";		
		} catch (Exception $e) {
			Cache::put($lab->token_name, 'null', 60);	
			echo $lab->token_name . " is {$e->getMessage()}. \n";			
		}
	}

	public static function get_token($lab)
	{
		if(Cache::has($lab->token_name)){
			if (Cache::get($lab->token_name) == null || Cache::get($lab->token_name) == 'null')
				self::login($lab);
		} else{
			self::login($lab);
		}
		// dd($lab);
		return Cache::get($lab->token_name);
	}

	public static function test_connection() {
		$labs = Lab::all();

		foreach ($labs as $lab) {
			try {
				$client = new Client(['base_uri' => $lab->base_url]);
				$response = $client->request('get', 'hello', [
					'headers' => [
						'Accept' => 'application/json',
					],
					// 'debug' => true,
		            'connect_timeout' => 3,
					'http_errors' => false,
					// 'verify' => false,
				]);
				$body = json_decode($response->getBody());
				echo $lab->name . ' '. $body->message . "<br /> \n";
				
			} catch (Exception $e) {
				echo $lab->name . ' at ' . $lab->base_url .  ' has error ' . $e->getMessage() . "<br /> \n";
			}
		}
	}

	public static function logins()
	{
		$labs = Lab::all();

		foreach ($labs as $lab) {
			self::login($lab);
		}
	}

	public function quarantine()
	{
		$connections = self::$db_connections;

		foreach ($connections as $key => $value) {
			DB::connection($value)->table('quarantine_sites')->where(['synched' => 0])->get();
			
		}
	}

	public static function kilifi()
	{
		CovidSample::whereNull('original_sample_id')->where(['lab_id' => 1])->update(['lab_id' => 12]);
	}

	public static function kilifi_dates()
	{
		$samples = CovidSample::whereNull('original_sample_id')->where(['lab_id' => 1])->get();

		foreach ($samples as $key => $sample) {
			if($sample->datecollected){
				$sample->datecollected = self::correct_date($sample->datecollected->toDateString());
			}
			if($sample->datetested){
				$sample->datetested = self::correct_date($sample->datetested->toDateString());
			}
			$sample->datedispatched = $sample->datetested;
			$sample->save();
		}
	}

	public static function correct_date($date)
	{
		if($date == '1970-01-01') return $date;
		$d = explode('-', $date);
		return ($d[0] . '-' . $d[2] . '-' . $d[1]);
	}

	public static function synch_to_nphl()
	{
		$samples = CovidSampleView::whereIn('result', [1,2])
						// ->where(['datedispatched' => date('Y-m-d', strtotime('-1 day')), 'sent_to_nphl' => 0])
						->where(['sent_to_nphl' => 0, 'repeatt' => 0])
						->where('datedispatched', '>', date('Y-m-d', strtotime('-6 days')))
						->with(['lab'])
						->limit(150)
						->get();

		$a = ['nationalities', 'covid_sample_types', 'covid_symptoms'];
		$lookups = [];
		foreach ($a as $value) {
			$lookups[$value] = DB::table($value)->get();
		}

		foreach ($lookups['covid_symptoms'] as $key => $value) {
			$symptoms_array[$key] = $value->name;
		}

		$client = new Client(['base_uri' => env('NPHL_URL')]);

		foreach ($samples as $key => $sample) {
			$travelled = 'No';
			$history = '';
			if (!$sample->patient->travel->isEmpty()){
				$travelled = 'Yes';
				foreach ($sample->patient->travel as $key => $travel) {
					if(!$travel->town) continue;
					$history .= $travel->town->name . ', ' . $travel->town->country . ';';
				}
			}

			$has_symptoms = 'No';
			$symptoms = '';
			if($sample->date_symptoms){
				$has_symptoms = 'Yes';
				if($sample->symptoms && is_array($sample->symptoms)){
					foreach ($sample->symptoms as $value) {
						$symptoms .= $symptoms_array[$value] . ';';
					}
				}
			}

			$post_data = [
				'USERNAME' => env('NPHL_USERNAME'),
				'PASSWORD' => env('NPHL_PASSWORD'),
				'TESTING_LAB' => $sample->lab->nphl_code,

				'CASE_ID' => $sample->identifier,
				'CASE_TYPE' => $sample->test_type == 1 ? 'Initial' : 'Repeat',
				'SAMPLE_TYPE' => $sample->get_prop_name($lookups['covid_sample_types'], 'sample_type', 'nphl_name'),
				'SAMPLE_NUMBER' => $sample->original_sample_id ?? $sample->id,
				'SAMPLE_COLLECTION_DATE' => $sample->datecollected ?? $sample->datetested,
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
				'AGE' => $sample->age ?? 0,
				'AGE_UNIT' => $sample->age_unit ?? 'Years',
				'GENDER' => substr($sample->gender, 0, 1),
				'OCCUPATION' => $sample->occupation,
				'NATIONALITY' => $sample->get_prop_name($lookups['nationalities'], 'nationality'),
				'NATIONAL_ID' => $sample->national_id ?? $sample->identifier,
				'COUNTY' => $sample->countyname ?? $sample->county,
				'SUB_COUNTY' => $sample->subcountyname ?? $sample->sub_county ?? $sample->subcounty ?? '',
				'WARD' => $sample->ward ?? $sample->residence,
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
			];

			// dd(self::get_token($lab));
			$response = $client->request('post', '', [
				'http_errors' => false,
				'verify' => false,
				'form_params' => $post_data,
			]);

			

			$body = json_decode($response->getBody());
			// dd($body);
			if($response->getStatusCode() < 400){
				if($body->status == 'SUCCESS'){
					$s = CovidSample::find($sample->id);
					$s->sent_to_nphl = 1;
					$s->time_sent_to_nphl = date('Y-m-d H:i:s');
					$s->save();
					echo 'Status code ' . $response->getStatusCode() . "\n";
				}
				if($body->status == 'ERROR'){
					$s = CovidSample::find($sample->id);
					$s->sent_to_nphl = 2;
					$s->save();
					print_r($body);
					continue;
				}

			}else{
				dd($body);
			}
		}
	}

	

	public static function synch_covid()
	{
		$labs = Lab::all();
		$samples = CovidSample::where(['synched' => 0])->whereNull('original_sample_id')->whereNull('receivedstatus')->with(['patient'])->get();
		foreach ($samples as $key => $sample) {
			$lab = $labs->where('id', $sample->lab_id)->first();
			// if(!$lab || in_array($lab->id, [7, 8, 10]) || !$lab->base_url) continue;
			if(!$lab || in_array($lab->id, [8, 10]) || !$lab->base_url) continue;
			// $lab = $labs->where('id', 7)->first();

			$client = new Client(['base_uri' => $lab->base_url]);
			// dd(self::get_token($lab));
			$response = $client->request('post', 'covid_sample', [
				'http_errors' => false,
				'verify' => false,
				'headers' => [
					'Accept' => 'application/json',
					'Authorization' => 'Bearer ' . self::get_token($lab),
				],
				'json' => [
					'sample' => $sample->toJson(),
				],
			]);

			$body = json_decode($response->getBody());
			if($response->getStatusCode() < 400){
				$sample->patient->original_patient_id = $body->patient->id;
				$sample->patient->save();

				$sample->original_sample_id = $body->sample->id;
				$sample->save();
			}else{
				dd($body);
			}
		}
	}

	public static function synch_cif()
	{
		// $client = new Client(['base_uri' => 'https://eoc.nascop.org:8084/openmrs/']);
		$client = new Client(['base_uri' => 'https://data.kenyahmis.org:7001/openmrs/']);

		while (true) {
			$samples = CovidSample::with(['patient'])
				->where(['repeatt' => 0])
				->whereNotNull('cif_sample_id')
				->whereNotNull('datedispatched')
				->whereNull('time_sent_to_cif')
				->limit(20)->get();
			$data = [];
			if(!$samples->count()) break;

			foreach ($samples as $key => $sample) {
				$data[] = [
					'patient_id' => (int) $sample->patient->cif_patient_id,
					'specimen_id' => (int) $sample->cif_sample_id,
					'result' => (int) $sample->result,
					'receivedstatus' => (int) $sample->receivedstatus,
					'rejectedreason' => '',
				];
			}

			$response = $client->request('post', 'ws/rest/v1/shr/labresults', [
				// 'debug' => true,
				'auth' => [env('CIF_USERNAME'), env('CIF_PASSWORD')],
				'http_errors' => false,
				'verify' => false,
				'headers' => [
					'Accept' => 'application/json',
				],
				'json' => $data,
			]);

			if($response->getStatusCode() < 400){
				$ids = $samples->pluck('id')->flatten()->toArray();
				CovidSample::whereIn('id', $ids)->update(['time_sent_to_cif' => date('Y-m-d H:i:s')]);
			}else{
				dd($response->getBody());
				break;
			}
		}
	}

	public static function cif_samples()
	{
		$samples = CovidSampleView::whereNotNull('cif_sample_id')
			->where('created_at', '>', date('Y-m-d', strtotime('-1 month')))
			->get();

		$data = [];

		foreach ($samples as $key => $sample) {

			$names = explode(' ', $sample->patient_name);
			$sql = '';

			foreach ($names as $key => $name) {
				$n = addslashes($name);
				$sql .= "patient_name LIKE '%{$n}%' AND ";
			}
			$sql = substr($sql, 0, -4);

			$s = CovidSampleView::whereNull('cif_sample_id')
				->where(['repeatt' => 0, 'national_id' => $sample->identifier])
				// ->whereRaw($sql)
				->whereBetween('datecollected', [$sample->datecollected->addDays(-2), $sample->datecollected->addDays(2)])
				->first();

			if(!$s) continue;

			$data[] = [
				'lab_id' => $s->lab_id,
				'cif_sample_id' => $sample->id,
				'lims_sample_id' => $s->id,
				'cif_patient_name' => $sample->patient_name,
				'lims_patient_name' => $s->patient_name,
				'cif_identifier' => $sample->identifier,
				'lims_identifier' => $s->identifier,
				'lims_national_id' => $s->national_id,
				'cif_datecollected' => $sample->datecollected,
				'lims_datecollected' => $s->datecollected,
				'lims_datetested' => $s->datetested,
				'lims_result' => $s->result,
			];
		}

		$file = 'cif_comparison_two';

        Common::csv_download($data, $file, true, true);

        Mail::to(['joel.kithinji@dataposit.co.ke'])->send(new TestMail([storage_path("exports/" . $file . ".csv")]));
	}


	public static function kilifi_notification()
	{
		// $samples = CovidSample::where(['lab_id' => 12, 'sent_to_nphl' => 1])->where('created_at', '>', date('Y-m-d H:i:s', strtotime('-1 day')))->count();
		$samples = CovidSample::where(['lab_id' => 12])->where('time_sent_to_nphl', '>', date('Y-m-d H:i:s', strtotime('-1 day')))->count();

        // Mail::to(['joelkith@gmail.com'])->send(new KilifiNPHLSamples($samples));
        Mail::to(['btsofa@kemri-wellcome.org', 'rongalo@kemri-wellcome.org', 'mkinuthia@kemri-wellcome.org', 'lmshote@kemri-wellcome.org', 'damadi@kemri-wellcome.org', 'eotieno@kemri-wellcome.org'])->cc(['joel.kithinji@dataposit.co.ke', 'tngugi@clintonhealthaccess.org'])->send(new KilifiNPHLSamples($samples));
	}
}
