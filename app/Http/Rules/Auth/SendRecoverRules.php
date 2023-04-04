<?php

namespace App\Http\Rules\Auth;

class SendRecoverRules
{
    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:users',
        ];
    }
}
