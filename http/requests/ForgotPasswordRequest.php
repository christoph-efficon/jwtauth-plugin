<?php

namespace Efficon\JWTAuth\Http\Requests;

use Efficon\JWTAuth\Http\Requests\Request;

class ForgotPasswordRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email'
        ];
    }
}
