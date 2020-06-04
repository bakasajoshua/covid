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
     * @Get("/verify/{id}")
     * @Transaction({
     * @Request({}, headers={"Authorization": "Bearer {token}"}),
     * @Response(200, body={
     *      "status": "ok",
     *      "identifier": "ID / Passport Number ",
     *      "name": "patient name",
     *      "area_of_residence": "residence",
     *      "date_tested": "YYYY-MM-DD",
     *      "lab": "lab that was tested",
     *      "result": "Positive / Negative",
     * }),
     * @Response(401, body={
     *      "message": "Token has expired",
     *      "status_code": 401,
     * }),
     * @Response(404, body={
     *      "status_code": 404,
     * })
     * })
     */
    public function show($id)
    {
        $sample = CovidSample::findOrFail($id);

        if($sample->result != 1) abort(404);

        return response()->json([
            'status' => 'ok',
            'identifier' => $sample->patient->identifier,
            'national_id' => $sample->patient->national_id,
            'name' => $sample->patient->patient_name,
            'sex' => $sample->patient->gender,
            'area_of_residence' => $sample->patient->residence,
            'date_tested' => $sample->datetested,
            'lab' => $sample->lab->name,
            'result' => $sample->result_name,
        ], 200);        
    }

}

