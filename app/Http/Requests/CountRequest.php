<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CountRequest extends FormRequest
{

    public function rules()
    {
        return [
            'started_at' => 'required|date_format:Y-m-d H:i:s',
            'ended_at' => 'required|date_format:Y-m-d H:i:s',
        ];
    }
}
