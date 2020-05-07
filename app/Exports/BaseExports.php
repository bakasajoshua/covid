<?php
namespace App\Exports;

use Carbon\Carbon;

class BaseExports
{
	public static function filterDate($model, $request)
	{
		if ($request->input('types') == 'daily_results_submission') 
		{
			$model = $model->whereDate('datetested', Carbon::now()->toDateString());
		} else {
			if ($request->input('period') == 'annually')
				$model = $model->whereYear('datetested', $request->input('year'));

			if ($request->input('period') == 'monthly')
				$model = $model->whereYear('datetested', $request->input('year'))
							->whereMonth('datetested', $request->input('month'));

			if ($request->input('period') == 'quarterly')
				$model = $model->whereYear('datetested', $request->input('year'))
							->whereRaw("MONTH(datetested) IN ({$this->quarters[$request->input('quarter')]})");

			if ($request->input('period') == 'range')
				$model = $model->whereRaw("DATE(datetested) BETWEEN '{$request->input('fromDate')}' AND '{$request->input('toDate')}'");
		}
		return $model;
	}
}