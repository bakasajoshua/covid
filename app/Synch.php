<?php

namespace App;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

use DB;
use Exception;

class Synch
{

	private static $db_connections = ['nairobi', 'alupe', 'kisumu', 'cpgh'];

	public function quarantine()
	{
		$connections = self::$db_connections;

		foreach ($connections as $key => $value) {
			DB::connection($value)->table('quarantine_sites')->where(['synched' => 0])->get();
			
		}
	}
}
