<?php

use Illuminate\Foundation\Inspiring;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('maps', function () {
	\App\Covid::edit_maps();
})->describe('Display an inspiring quote');

Artisan::command('reference', function () {
	\App\Covid::dump_reference_tables();
})->describe('Display an inspiring quote');

Artisan::command('nphl', function () {
	\App\Synch::synch_to_nphl();
})->describe('Synch to NPHL');

Artisan::command('kilifi', function () {
	\App\Synch::kilifi_notification();
})->describe('Send Kilifi notificaiton');

Artisan::command('synch:covid', function(){
    $str = \App\Synch::synch_covid();
    $this->info($str);
})->describe('Synch Covid');

Artisan::command('synch:cif', function(){
    $str = \App\Synch::synch_cif();
    $this->info($str);
})->describe('Synch back to CIF');