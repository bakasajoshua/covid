<?php

namespace App\Api\V1\Requests;

use Config;
use Dingo\Api\Http\FormRequest;

class CredentialRequestRequest extends FormRequest
{
    public function rules()
    {
        return Config::get('boilerplate.credential_request.validation_rules');
    }

    public function authorize()
    {
        return true;
    }
}
