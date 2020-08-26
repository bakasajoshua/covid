<?php

namespace App\Http\Controllers;

use App\Exports\DailyReportExport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CovidReportController extends Controller
{
    public function index(Request $request)
    {
    	if ($request->method() == 'GET'){
    		return view('forms.reports');
    	} else {
    		$date = Carbon::parse($request->input('date_filter'))->format('Y-m-d');
    		return Excel::download(new DailyReportExport($request), 'DAILY COVID-19 LABORATORY RESULTS ' . $date . '.csv');
    	}
    }
}
