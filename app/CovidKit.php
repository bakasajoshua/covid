<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CovidKit extends BaseModel
{
    protected $connection = 'nat';

    public function computekitsUsed($tests)
    {
    	if ($tests == 0 || $this->calculated_pack_size == NULL)
    		return 0;
    	
    	return (int)ceil($tests/$this->calculated_pack_size);
    }

    public function beginingbalance()
    {
    	$balance = 0;
    	$last_week = $this->getPreviousWeek();
    	$last_week_consumption = CovidConsumption::whereDate('start_of_week', $last_week->week_start)
    								->where('lab_id', auth()->user()->lab_id)->get();
    	
    	if (!$last_week_consumption->isEmpty()){
    		$details = $last_week_consumption->first()->details->where('kit_id', $this->id);
    		if (!$details->isEmpty()){
    			$balance = $details->first()->ending;
    		}
    	}
    								
    	return $balance;
    }

    private function getPreviousWeek()
    {
    	$date = strtotime('-14 days', strtotime(date('Y-m-d')));
    	return $this->getStartAndEndDate(date('W', $date),
    							date('Y', $date));
    }

    private function getStartAndEndDate($week, $year) {
		$dto = new \DateTime();
		$dto->setISODate($year, $week);
		$ret['week_start'] = $dto->format('Y-m-d');
		$dto->modify('+6 days');
		$ret['week_end'] = $dto->format('Y-m-d');
		$ret['week'] = date('W', strtotime($ret['week_start']));
		return (object)$ret;
	}
}
