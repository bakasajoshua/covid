<?php

namespace App\Api\V1\Controllers;

use App\Http\Controllers\Controller;
use App\Api\V1\Requests\BlankRequest;


use App\CovidWorksheet;
use App\CovidPatient;
use App\CovidSample;
use App\CovidTravel;
use App\Facility;
use DB;

class VerifySampleController extends Controller
{
  

    /**
     * Display the specified resource.
     *
     * @Get("/{id}")
     * @Response(200, body={
     *      "sample": {
     *          "id": "int",    
     *          "patient": {
     *              "id": "int",
     *          }    
     *      }
     * })
     */
    public function show($id)
    {
        $sample = CovidSample::findOrFail($id);

        return response()->json([
            'status' => 'ok',
            'identifier' => $sample->patient->identifier,
            'area_of_residence' => $sample->patient->residence,
            'date_tested' => $sample->datetested,
            'lab' => $sample->lab->name,
            'result' => $sample->result_name,
        ], 200);        
    }

}

