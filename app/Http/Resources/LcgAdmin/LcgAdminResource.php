<?php

namespace App\Http\Resources\LcgAdmin;

use Illuminate\Http\Resources\Json\JsonResource;

class LcgAdminResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
