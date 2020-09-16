<?php

namespace App\Http\Resources\Version;

use App\Commons\BaseResource;
use App\Models\Version;

class VersionResource extends BaseResource
{
    /**
     * @author : Phi .
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $json                      = $this->json;
        $json['result']['version'] = '';

        if ($this->resource instanceof Version) {
            $json['result']['version'] = $this->resource->version;
        }

        $this->json = $json;

        return $this->json;
    }
}
