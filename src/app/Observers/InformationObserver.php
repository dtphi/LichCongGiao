<?php

namespace App\Observers;

use App\Models\Information;

class InformationObserver
{
    /**
     * @author : Phi .
     * @param Information $info
     */
    public function deleted(Information $info)
    {
        $info->status = 0;

        $info->save();
    }
}
