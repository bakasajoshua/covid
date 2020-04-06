<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\CovidSample;
use App\CovidPatient;
use App\CovidSampleView;
use Carbon\CarbonPeriod;
use Carbon\Carbon;
use DB;
use Str;

class ChartsController extends Controller
{

	public function index()
	{
		return view('pages.index');
	}

	public function homepage()
	{
		$positives = CovidSample::selectRaw("count(id) as total")->where(['result' => 2, 'repeatt' => 0])->first()->total;
		$deceased = CovidSampleView::selectRaw("count(id) as total")->where(['result' => 2, 'repeatt' => 0])->whereNotNull('date_death')->first()->total;
		$discharged = CovidSampleView::selectRaw("count(id) as total")->where(['result' => 2, 'repeatt' => 0])->whereNotNull('date_recovered')->first()->total;
		$hospitalised = 0;
		return view('pages.home', compact('positives', 'deceased', 'hospitalised', 'discharged'));
	}

	public function main()
	{
		$rows = CovidSample::leftJoin('countys', 'countys.id', '=', 'covid_samples.county_id')
			->where(['repeatt' => 0, 'result' => 2])
			->selectRaw("county_id as id, countys.name, COUNT(DISTINCT covid_samples.patient_id) as value")
			->groupBy('county_id')
			->get();

		$data = [];
		$positives = 0;

		foreach ($rows as $key => $row) {
			$data[] = [
				'id' => $row->id,
				'name' => $row->name,
				'value' => (int) $row->value,
			];
			$positives += $row->value;
		}

		$total = CovidSample::selectRaw("count(covid_samples.id) as value")->first()->value;

		return view('pages.data', compact('data', 'positives', 'total'));
	}

	public function test()
	{
		$rows = CovidSample::selectRaw("county_id as id, countys.name, COUNT(DISTINCT covid_samples.patient_id) as value")
			->leftJoin('countys', 'countys.id', '=', 'covid_samples.county_id')
			->where(['repeatt' => 0, 'result' => 2])
			->groupBy('county_id')
			->orderBy('value', 'desc')
			->get();

		$data = [];
		$positives = 0;

		foreach ($rows as $key => $row) {
			$data[] = [
				'id' => $row->id,
				'name' => $row->name,
				'value' => (int) $row->value,
			];
			$positives += $row->value;
		}

		$total = CovidSample::selectRaw("count(covid_samples.id) as value")->first()->value;


		return view('pages.data', compact('data', 'positives', 'total'));
	}

	public function daily_view()
	{
		$pos_rows = CovidSample::selectRaw("datetested, COUNT(DISTINCT covid_samples.patient_id) as value")
			->where(['repeatt' => 0, 'result' => 2])
			->groupBy('datetested')
			->orderBy('datetested', 'asc')
			->get();

		$period = new CarbonPeriod('2020-03-14', date('Y-m-d'));

		$chart['outcomes'][0]['name'] = 'New Confirmed Cases';
		$chart['outcomes'][0]['type'] = 'column';
		$chart['outcomes'][1]['name'] = 'Cumulative Confirmed Cases';
		$chart['outcomes'][1]['type'] = 'spline';

		$i = 0;
		$cumulative = 0;

		foreach ($period as $key => $day) {
			$chart['categories'][$key] = $day->toDateString();

			if(isset($pos_rows[$i]) && $pos_rows[$i]->datetested->equalTo($day)){
				$chart["outcomes"][0]["data"][$key] = (int) $pos_rows[$i]->value;
				$cumulative += (int) $pos_rows[$i]->value;
				$i++;
			}
			else{
				$chart["outcomes"][0]["data"][$key] = 0;				
			}
			$chart["outcomes"][1]["data"][$key] = $cumulative;
		}

		$chart['div'] = Str::random(15);
		$chart['yAxis'] = 'Cases';
		// return json_encode($pos_rows);
		return view('charts.bar_graph', $chart);
	}

	public function county_chart()
	{
		$chart['outcomes'][0]['name'] = 'New Confirmed Cases';
		$chart['outcomes'][0]['type'] = 'column';
		$chart['yAxis'] = 'Cases By County';
		$chart['div'] = Str::random(15);

		$rows = CovidSampleView::selectRaw("county_id as id, countys.name, COUNT(DISTINCT covid_sample_view.patient_id) as value")
			->join('national_db.countys', 'countys.id', '=', 'covid_sample_view.county_id')
			->where(['repeatt' => 0, 'result' => 2])
			->groupBy('county_id')
			->get();

		foreach ($rows as $key => $value) {
			$chart['categories'][$key] = $value->name;
			$chart["outcomes"][0]["data"][$key] = (int) $value->value;	
		}
		return view('charts.bar_graph', $chart);
	}

	public function gender_pie()
	{
		$chart['div'] = Str::random(15);
		$chart['donut'] = true;

		$rows = CovidSampleView::selectRaw("sex, count(DISTINCT covid_sample_view.patient_id) as value")
			->where(['repeatt' => 0, 'result' => 2])
			->groupBy('sex')
			->orderBy('sex', 'asc')
			->get();

		$chart['outcomes']['name'] = "Cases By Gender";
		$chart['outcomes']['colorByPoint'] = true;

		$chart['outcomes']['innerSize'] = '50%';
		$chart['outcomes']['data'][0]['name'] = "Male";
		$chart['outcomes']['data'][1]['name'] = "Female";

		$chart['outcomes']['data'][0]['y'] = (int) $rows->where('sex', 1)->first()->value ?? 0;
		$chart['outcomes']['data'][1]['y'] = (int) $rows->where('sex', 2)->first()->value ?? 0;

		return view('charts.pie_chart', $chart);
	}

	public function pyramid()
	{
		$chart['div'] = Str::random(15);

		$age_categories = DB::table('age_categories')->get();

		$samples = CovidSampleView::selectRaw("age_category, sex, COUNT(DISTINCT covid_sample_view.patient_id) as value")
			->where(['repeatt' => 0, 'result' => 2])
			->groupBy('age_category')
			->groupBy('sex')
			->get();

		$chart['outcomes'][0]['name'] = 'Male';
		$chart['outcomes'][1]['name'] = 'Female';

		foreach ($age_categories as $key => $value) {
			$chart['categories'][$key] = $value->name;
			$male = $samples->where('age_category', $value->id)->where('sex', 1)->first()->value ?? 0;
			$female = $samples->where('age_category', $value->id)->where('sex', 2)->first()->value ?? 0;

			$chart["outcomes"][0]["data"][$key] = - ((int) $male);
			$chart["outcomes"][1]["data"][$key] = (int) $female;
		}
		return view('charts.population', $chart);
	}

	public function map_data()
	{
		$rows = CovidSampleView::selectRaw("county_id as id, countys.name, COUNT(DISTINCT covid_sample_view.patient_id) as value")
			->leftJoin('countys', 'countys.id', '=', 'covid_sample_view.county_id')
			->where(['repeatt' => 0, 'result' => 2])
			->groupBy('county_id')
			->get();

		$data = [];
		$positives = 0;

		foreach ($rows as $key => $row) {
			$data[] = [
				'id' => $row->id,
				'name' => $row->name,
				'value' => (int) $row->value,
			];
			$positives += $row->value;
		}

		// $total = CovidSample::selectRaw("count(covid_samples.id) as value")->first()->value;

		$chart['data'] = $data;

		$chart['div'] = Str::random(15);
		return view('charts.map', $chart);
	}

	public function labs()
	{
		$prev_samples = CovidSample::selectRaw('lab_id, result, count(DISTINCT patient_id) as value')
		->where(['repeatt' => 0])
		->whereNotNull('result')
		->where('datetested', '<', date('Y-m-d'))
		->groupBy('lab_id', 'result')
		->orderBy('lab_id')
		->get();

		$new_samples = CovidSample::selectRaw('lab_id, result, count(DISTINCT patient_id) as value')
		->where(['repeatt' => 0])
		->whereNotNull('result')
		->where('datetested', date('Y-m-d'))
		->groupBy('lab_id', 'result')
		->orderBy('lab_id')
		->get();


		$labs = DB::table('labs')->where('active', 1)->get();

		$lab = null;
		$data = [];
		$total_array = ['lab' => 'Total', 'last_updated' => '', 'prev_pos' => 0, 'prev_total' => 0, 'new_pos' => 0, 'new_total' => 0, 'pos' => 0, 'total' => 0];

		foreach ($labs as $key => $value) {
			$lab = $value->name;

			$last_updated = CovidSample::where(['repeatt' => 0, 'lab_id' => $value->id])->whereNotNull('result')->orderBy('id', 'desc')->first()->updated_at ?? '';

			$prev_pos = $prev_samples->where('lab_id', $value->id)->where('result', 2)->first()->value ?? 0;
			$prev_total = ($prev_samples->where('lab_id', $value->id)->where('result', 1)->first()->value ?? 0) + $prev_pos;

			$new_pos = $new_samples->where('lab_id', $value->id)->where('result', 2)->first()->value ?? 0;
			$new_total = ($new_samples->where('lab_id', $value->id)->where('result', 1)->first()->value ?? 0) + $new_pos;

			$pos = $prev_pos + $new_pos;
			$total = $prev_total + $new_total;

			$data[] = compact('lab', 'prev_pos', 'prev_total', 'new_pos', 'new_total', 'pos', 'total', 'last_updated');

			$total_array['prev_pos'] += $prev_pos;
			$total_array['prev_total'] += $prev_total;

			$total_array['new_pos'] += $new_pos;
			$total_array['new_total'] += $new_total;

			$total_array['pos'] += $pos;			
			$total_array['total'] += $total;			
		}
		$data[] = $total_array;
		return view('pages.labs', compact('data', 'samples'));		
	}

}
