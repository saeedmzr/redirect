<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLinkRequest extends FormRequest
{



    public function rules()
    {
        return [
            'inputed_link' => 'required|url'
        ];
    }
}
