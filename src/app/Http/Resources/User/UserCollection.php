<?php

namespace App\Http\Resources\User;

use App\Commons\BaseCollection;

class UserCollection extends BaseCollection
{
    /**
     * @author : Phi .
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @param array $data
     * @return mixed
     */
    public function toArray($request)
    {
        $json = $this->json;

        foreach ($this->resource as $user) {
            $json['items'][] = [
                'id'         => $user->user_id,
                'name'       => $user->name,
                'email'      => $user->email,
                'created_at' => $user->created_at
            ];
        }

        return $json;
    }
}
