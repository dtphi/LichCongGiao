<?php

namespace App\Http\Resources\Information;

use App\Commons\BaseCollection;

class InformationCollection extends BaseCollection
{
    /**
     * @author : Phi .
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $json                          = $this->json;
        $json['result']['information'] = [];

        foreach ($this->resource as $info) {
            $json['result']['information'][] = [
                'info_id'         => $info->info_id,
                'info_title'      => $info->info_title,
                'info_contents'   => $info->info_contents,
                'disp_start_date' => $info->disp_start_date,
                'disp_end_date'   => $info->disp_end_date,
                'status'          => $info->status,
                'created_at'      => date($info->created_at)
            ];
        }
        $this->json = $json;

        return $this->json;
    }
}
