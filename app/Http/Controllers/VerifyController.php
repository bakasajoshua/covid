<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\CovidSampleView;

class VerifyController extends Controller
{

	public function index()
	{
		return view('forms.verify');
	}

	public function qrcode(Request $request)
	{
		$sample = CovidSampleView::where('identifier', $request->input('identifier'))
			->where(['repeatt' => 0, 'receivedstatus' => 1])
			->whereIn('result', [1])
			->orderBy('datetested', 'desc')
			->first();

		return view('forms.code', compact('sample'));
	}
}
