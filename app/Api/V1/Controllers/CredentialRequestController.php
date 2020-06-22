<?php

namespace App\Api\V1\Controllers;

use App\Http\Controllers\Controller;
use App\Api\V1\Requests\BlankRequest;
use App\Api\V1\Requests\CredentialRequestRequest;


use App\CredentialRequest;
use DB;

class CredentialRequestController extends Controller
{
  
    public function index(BlankRequest $request)
    {

    }

    
    public function store(CredentialRequestRequest $request)
    {
        $c = CredentialRequest::create($request->all());

        return response()->json([
            'status' => 'ok',
            'credential_request' => $c,
        ], 201);
    }


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

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function update(BlankRequest $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}

