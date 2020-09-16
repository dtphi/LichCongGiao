<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 8/27/2020
 * Time: 2:48 PM
 */

namespace App\LcgModelServices\LcgContracts\LcgAdmin;


interface LcgAdminUserContract
{
    public function adGetLists($filters = [], $limit = 0);
}
