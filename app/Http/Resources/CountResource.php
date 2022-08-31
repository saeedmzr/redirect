<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CountResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'user_id' => $this['id'],
            'date' => $this['date'],
            'view_count' => $this['view_count'],

        ];
    }

}
