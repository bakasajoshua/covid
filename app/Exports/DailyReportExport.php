<?php

namespace App\Exports;
use App\CovidSampleView;
use App\Lab;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;

class DailyReportExport implements FromCollection
{
	private $request;
	function __construct(Request $request)
	{
		$this->request = $request;
	}
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
    	$data = collect($this->getData());
    	
        return $data;
    }

    private function getData()
    {
    	// Get the dates
		$date = Carbon::parse($this->request->input('date_filter'))->format('Y-m-d');
		
		// Get the data from the database
		$today_data = $this->get_model()->whereDate('datetested', $date)->orderBy('result', 'desc')->get();
		$last_update_data = $this->get_model()->whereRaw("DATE(datetested) < '{$date}'")->get();
		
		// Prepare the data to fill the excel
		return $this->prepareData($today_data, $last_update_data, $date);

    }

	private function get_model()
	{
		return CovidSampleView::where('repeatt', 0)->whereNotNull('result');
	}

	private function prepareData($today_data, $last_update_data, $date)
	{
		$date = Carbon::parse($this->request->input('date_filter'))->format('Y-m-d');
		$data = [['DAILY COVID-19 LABORATORY RESULTS SUBMISSION ' . $date]];
		$data[] = [
			'Date', 'Testing Laboratory', 'Cumulative number of samples tested as at last update', 'Number of samples tested since last update', 'Cumulative number of samples tested to date ', 'Cumulative positive tests as at last update ', 'Number of new Positive tests', 'Cumulative Positive samples since onset of outbreak'
		];
		foreach ($this->get_summary_data($today_data, $last_update_data, $date) as $key => $value) {
			$data[] = $value;
		}
		
		for ($i=0; $i < 2; $i++) { 
			$data[] = [""];
		}

		foreach ($this->get_detailed_data($today_data) as $key => $value) {
			$data[] = $value;
		}
		
		return $data;
	}

	private function get_summary_data($today_data, $last_update_data, $date)
	{
		$data = [];
		foreach ($today_data->groupBy('lab_id') as $key => $labdata) {
			$update_data = $last_update_data->where('lab_id', $key);
			$data[] = [
				$date,
				Lab::find($key)->labdesc,
				$update_data->count(),
				$labdata->count(),
				($update_data->count() + $labdata->count()),
				$update_data->whereIn('result', [2,8])->count(),
				$labdata->whereIn('result', [2,8])->count(),
				($update_data->whereIn('result', [2,8])->count() + $labdata->whereIn('result', [2,8])->count())
			];
		}
		return $data;
	}

	private function get_detailed_data($alldata)
	{
		$data = [['Testing Lab', 'S/N', 'Name', 'Age', 'Sex', 'ID/ Passport Number', 'Justification', 'Health Status',
				'Telephone Number', 'County of Residence', 'Sub-County', 'Travel History (Y/N)',
				'Where from', 'history of contact with confirmed case', 'Facility Name (Quarantine /health facility)', 'Name of Confirmed Case', 'Worksheet Number', 'Date Collected', 'Date Tested', 'Result', 'Test Type'
				]];
		$count = 1;
		$a = ['covid_justifications', 'health_statuses'];
		$lookups = [];
		foreach ($a as $value) {
			$lookups[$value] = DB::table($value)->get();
		}
		foreach ($alldata as $key => $row) {
			$data[] = $this->get_excel_samples($row, $count, $lookups);
			$count++;
		}
		return $data;
	}

	private function get_excel_samples($sample, $count, $lookups)
	{
		$travelled = 'N';
		$history = '';
		if (!$sample->patient->travel->isEmpty()){
			$travelled = 'Y';
			foreach ($sample->patient->travel as $key => $travel) {
				$history .= $travel->city . ', ' . $travel->country . '\n';
			}
		}
		return [
			// Lab::find(env('APP_LAB'))->labdesc,
			Lab::find($sample->lab_id)->labdesc,
			$count,
			$sample->patient_name,
			$sample->age,
			$sample->gender,
			$sample->identifier,
			$sample->get_prop_name($lookups['covid_justifications'], 'justification'),
			$sample->get_prop_name($lookups['health_statuses'], 'health_status'),
			$sample->phone_no ?? '',
			$sample->countyname ?? '',
			$sample->subcountyname ?? $sample->subcounty ?? '',

			$travelled,
			$history,
			"",
			$sample->quarantine_site ?? $sample->facilityname ?? '',
			"",
			$sample->worksheet_id ?? '',
			$sample->datecollected ?? '',
			$sample->datetested ?? '',
			$sample->result_name,
			$sample->sampletype ?? ''
		];
	}
}
