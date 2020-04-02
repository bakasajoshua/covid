<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\CovidSample;
use Carbon\CarbonPeriod;
use Carbon\Carbon;
use Str;
use DB;

class ChartController extends Controller
{

	public function index()
	{
		return view('pages.index');
	}

	public function labs()
	{
		$samples = DB::table('covid_19.covid_samples')
		->leftJoin('national_db.labs', 'labs.id', '=', 'covid_samples.lab_id')
		->selectRaw('labs.name as lab, covid_samples.result, count(covid_samples.id) as sample_count')
		->whereNotNull('covid_samples.result')
		->groupBy('labs.id', 'result')
		->orderBy('labs.id')
		->get();
		$samples = collect($samples);

		$labs = $samples->pluck('lab')->distinct()->toArray();

		$lab = null;
		$data = [];
		$total = 0;
		foreach ($labs as $key => $value) {
			$neg = $samples->where('lab', $value)->where('result', 1)->first()->sample_count ?? 0;
			$pos = $samples->where('lab', $value)->where('result', 2)->first()->sample_count ?? 0;
			$data[] = [
				'lab' => $value,
				'pos' => $pos,
				'neg' => $neg,
				'total' => $pos+$neg,
			];
		}

		return view('pages.labs', compact('data', 'samples'));		
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
