<?php

namespace App\Http\Rules\Auth;

class RecoverRules
{
    public function rules(): array
    {
        return [
            'recovering_token' => 'required|string|min:32|max:32|exists:users',
            'password' => 'required|string|min:6'
        ];
    }
}
