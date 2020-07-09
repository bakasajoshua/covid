<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Common;
use App\CovidSampleView;
use DB;

class MiscController extends Controller
{

	public function nphl_download()
	{
		$samples = CovidSampleView::where('repeatt', 0)
						->whereIn('result', [1,2])
						// ->where(['datedispatched' => date('Y-m-d', strtotime('-1 day')), 'sent_to_nphl' => 0])
						->where(['sent_to_nphl' => 0, 'lab_id' => 1])
						->whereNull('original_sample_id')
						->where('datedispatched', '>', date('Y-m-d', strtotime('-3 days')))
						->with(['lab'])
						// ->limit(200)
						->get();

		$a = ['nationalities', 'covid_sample_types', 'covid_symptoms'];
		$lookups = $data = [];
		foreach ($a as $value) {
			$lookups[$value] = DB::table($value)->get();
		}

		foreach ($lookups['covid_symptoms'] as $key => $value) {
			$symptoms_array[$key] = $value->name;
		}

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
				if($sample->symptoms){
					foreach ($sample->symptoms as $value) {
						$symptoms .= $symptoms_array[$value] . ';';
					}
				}
			}

			$post_data = [
				'TESTING_LAB' => '00030',

				'CASE_ID' => $sample->identifier,
				'CASE_TYPE' => $sample->test_type == 1 ? 'Initial' : 'Repeat',
				'SAMPLE_TYPE' => $sample->get_prop_name($lookups['covid_sample_types'], 'sample_type', 'nphl_name'),
				'SAMPLE_NUMBER' => $sample->original_sample_id ?? $sample->id,
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

			$data[] = $post_data;
		}
		return Common::csv_download($data, 'nphl_download');
	}
}
