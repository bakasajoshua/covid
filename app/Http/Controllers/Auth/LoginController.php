<?php

namespace App\Http\Controllers\Auth;

use App\CovidConsumption;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    // protected $redirectTo = '/';
    protected function redirectTo()
    {
        return $this->postLoginChecks();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    private function postLoginChecks()
    {
        dd('Kill it all here');
        if (null !== auth()->user()->lab_id) {
            $time = $this->getPreviousWeek();
            $consumption = CovidConsumption::whereDate('start_of_week', $time->week_start)->where('lab_id', auth()->user()->lab_id)->get();
            
            if ($consumption->isEmpty()) 
                return '/kits';
        }

        return '/';
    }


    private function getPreviousWeek()
    {
     $date = strtotime('-7 days', strtotime(date('Y-m-d')));
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
