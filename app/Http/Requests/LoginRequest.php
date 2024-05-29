<?php

namespace App\Http\Requests;

use Laravel\Fortify\Http\Requests\LoginRequest as FortifyLoginRequest;
use Laravel\Fortify\Fortify;
use App\Rules\ReCaptcha;

class LoginRequest extends FortifyLoginRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            Fortify::username() => 'required|string',
            'password' => 'required|string',
            'g-recaptcha-response' => ['required', new ReCaptcha]
        ];
    }
}
