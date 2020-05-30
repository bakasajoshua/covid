<?php

namespace App\Api\V1\Controllers;

use App\Http\Controllers\Controller;

use App\CovidSample;

class VerifySampleController extends Controller
{
  

    /**
     * Display the specified resource.
     *
     * Authorization: bearer {token}
     *
     * @Get("/{id}")
     * @Response(200, body={
     *      "status": "ok",
     *      "identifier": "ID / Passport Number ",
     *      "name": "patient name",
     *      "area_of_residence": "residence",
     *      "date_tested": "YYYY-MM-DD",
     *      "lab": "lab that was tested",
     *      "result": "positive / negative",
     * })
     */
    public function show($id)
    {
        $sample = CovidSample::findOrFail($id);

        return response()->json([
            'status' => 'ok',
            'identifier' => $sample->patient->identifier,
            'name' => $sample->patient->patient_name,
            'area_of_residence' => $sample->patient->residence,
            'date_tested' => $sample->datetested,
            'lab' => $sample->lab->name,
            'result' => $sample->result_name,
        ], 200);        
    }

}

