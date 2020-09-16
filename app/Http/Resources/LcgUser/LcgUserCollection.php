<?php

namespace App\Http\Resources\LcgUser;

use Illuminate\Http\Resources\Json\ResourceCollection;

class LcgUserCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
