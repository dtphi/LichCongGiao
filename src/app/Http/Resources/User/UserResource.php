<?php

namespace App\Http\Resources\User;

use App\Commons\BaseResource;
use App\Models\Member;

class UserResource extends BaseResource
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
        $json = $this->json;

        if (!is_null($this->resource) && $this->resource instanceof Member) {
            $json['item'] = [
                'id'         => $this->user_id,
                'name'       => $this->name,
                'email'      => $this->email,
                'created_at' => $this->created_at
            ];
        }

        return $json;
    }
}
