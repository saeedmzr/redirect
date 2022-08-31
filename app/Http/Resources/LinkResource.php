<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LinkResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'inputed_link' => $this->inputed_link,
            'generated_link' => env('APP_URL') . $this->generated_link,
            'view_count' => $this->view_count,
            'created_at' => $this->created_at,

        ];
    }

}
