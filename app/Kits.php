<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kits extends Model
{
    /**
     * The connection type used for this model
     *
     * @var string
     */
    protected $connection = 'nat';
    
    
    protected $guarded = [];
	protected $year;
    protected $previousYear;
    protected $month;
    protected $previousMonth;

    public function __construct(){
        $this->year = date('Y');
        $this->month = date('m');

        $this->previousYear = $this->year;
        $this->previousMonth = $this->month - 1;
        if ($this->month == 1) {
            $this->previousMonth = 12;
            $this->previousYear = $this->year-1;
        }
    }

    public function machine() {
    	return $this->belongsTo('App\Machine');
    }

    public function lastMonth(){
    	return $this->consumption->where('year', '=', $this->previousYear)->where('month', '=', $this->previousMonth);
    }
   
    public function commodities()
    {
        return $this->morphMany('App\AllocationDetailsBreakdown', 'breakdown');
    }
   
    public function commodities_consumption()
    {
        return $this->morphMany('App\ConsumptionDetailBreakdown', 'consumption_breakdown');
    }
}
