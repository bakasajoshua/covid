<?php

namespace App\Api\V1\Requests;

use Dingo\Api\Http\FormRequest;

class CovidApiRequest extends FormRequest
{
    public function rules()
    {
        return config('boilerplate.covid_sample');;
    }

    public function authorize()
    {
    	return true;
    }
}
