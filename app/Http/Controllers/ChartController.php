<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\CovidSample;

class ChartController extends Controller
{

	public function index()
	{
		return view('pages.index');
	}

	public function test()
	{
		$rows = CovidSample::join('countys', 'countys.id', '=', 'covid_samples.county_id')
			->where('result', 2)
			->selectRaw("county_id as id, countys.name, count(covid_samples.id) as value")
			->groupBy('county_id')
			->get();

		$data = [];

		foreach ($rows as $key => $row) {
			$data[] = [
				'id' => $row->id,
				'name' => $row->name,
				'value' => (int) $row->value,
			];
		}

		return view('pages.data', ['data' => $data]);
	}
}
