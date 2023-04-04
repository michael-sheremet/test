<?php

namespace App\Http\Rules\Company;

class CreateRules
{
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'phone' => 'required|string|min:10',
            'description' => 'required|string'
        ];
    }
}
