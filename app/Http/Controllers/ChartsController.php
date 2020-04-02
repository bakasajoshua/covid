<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\CovidSample;
use App\CovidSampleView;
use Carbon\CarbonPeriod;
use Carbon\Carbon;
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
		$hospitalised = $discharged = 0;
		return view('pages.home', compact('positives', 'deceased', 'hospitalised', 'discharged'));
	}

	public function main()
	{
		$rows = CovidSample::leftJoin('countys', 'countys.id', '=', 'covid_samples.county_id')
			->where('result', 2)
			->where('repeatt', 0)
			->selectRaw("county_id as id, countys.name, count(covid_samples.id) as value")
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
		$rows = CovidSample::leftJoin('countys', 'countys.id', '=', 'covid_samples.county_id')
			->where('result', 2)
			->where('repeatt', 0)
			->selectRaw("county_id as id, countys.name, count(covid_samples.id) as value")
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
		$pos_rows = CovidSample::where('result', 2)
			->selectRaw("datetested, count(covid_samples.id) as value")
			->where('repeatt', 0)
			->groupBy('datetested')
			->orderBy('datetested', 'asc')
			->get();

		$period = new CarbonPeriod('2020-03-10', date('Y-m-d'));

		$chart['outcomes'][0]['name'] = 'New Confirmed Cases';
		$chart['outcomes'][0]['type'] = 'column';
		$chart['outcomes'][1]['name'] = 'Cumulative Confirmed Cases';
		$chart['outcomes'][1]['type'] = 'spline';

		$i = 0;
		$cumulative = 0;

		foreach ($period as $key => $day) {
			$chart['categories'][$key] = $day->toDateString();

			if(isset($pos_rows[$i]) && $pos_rows[$i]->datetested == $day->toDateString()){
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
		return view('charts.bar_graph', $chart);
	}

	public function map_data()
	{
		$rows = CovidSample::leftJoin('countys', 'countys.id', '=', 'covid_samples.county_id')
			->where('result', 2)
			->where('repeatt', 0)
			->selectRaw("county_id as id, countys.name, count(covid_samples.id) as value")
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
}