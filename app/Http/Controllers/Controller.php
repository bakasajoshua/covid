<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

 //    public function getPreviousWeek()
 //    {
 //    	$date = strtotime('-7 days', strtotime(date('Y-m-d')));
 //    	return $this->getStartAndEndDate(date('W', $date),
 //    							date('Y', $date));
 //    }

 //    public function getStartAndEndDate($week, $year) {
	// 	$dto = new \DateTime();
	// 	$dto->setISODate($year, $week);
	// 	$ret['week_start'] = $dto->format('Y-m-d');
	// 	$dto->modify('+6 days');
	// 	$ret['week_end'] = $dto->format('Y-m-d');
	// 	$ret['week'] = date('W', strtotime($ret['week_start']));
	// 	return (object)$ret;
	// }
}
