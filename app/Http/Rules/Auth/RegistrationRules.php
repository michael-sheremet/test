<?php

namespace App\Http\Rules\Auth;

class RegistrationRules
{
    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:users',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'password' => 'required|string|min:6',
            'phone' => 'required|string|min:10'
        ];
    }
}
