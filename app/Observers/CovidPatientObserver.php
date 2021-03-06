<?php

namespace App\Observers;

use App\CovidPatient;
use App\ViewFacility;
use DB;

class CovidPatientObserver
{
    /**
     * Handle the covid patient "saving" event.
     *
     * @param  \App\CovidPatient  $covidPatient
     * @return void
     */
    public function saving(CovidPatient $covidPatient)
    {
        if($covidPatient->county && !$covidPatient->county_id){
            $county = DB::table('countys')->where('name', $covidPatient->county)->first();
            $covidPatient->county_id = $county->id ?? null;
        }
        /*if(!$covidPatient->county && $covidPatient->county_id){
            $county = DB::table('countys')->where('id', $covidPatient->county_id)->first();
            $covidPatient->county = $county->name ?? null;            
        }*/
    }

    /**
     * Handle the covid patient "updated" event.
     *
     * @param  \App\CovidPatient  $covidPatient
     * @return void
     */
    public function updated(CovidPatient $covidPatient)
    {
        //
    }

    /**
     * Handle the covid patient "deleted" event.
     *
     * @param  \App\CovidPatient  $covidPatient
     * @return void
     */
    public function deleted(CovidPatient $covidPatient)
    {
        //
    }

    /**
     * Handle the covid patient "restored" event.
     *
     * @param  \App\CovidPatient  $covidPatient
     * @return void
     */
    public function restored(CovidPatient $covidPatient)
    {
        //
    }

    /**
     * Handle the covid patient "force deleted" event.
     *
     * @param  \App\CovidPatient  $covidPatient
     * @return void
     */
    public function forceDeleted(CovidPatient $covidPatient)
    {
        //
    }
}
