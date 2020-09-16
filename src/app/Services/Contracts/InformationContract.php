<?php
/**
 * Created by PhpStorm.
 * User: Phi
 * Date: 3/6/2020
 * Time: 10:59 AM
 */

namespace App\Services\Contracts;

use App\Models\Information;

interface InformationContract
{
    /**
     * @author : Phi .
     * @param array $data
     * @return mixed
     */
    public function adInsert($data = []);

    /**
     * @author : Phi .
     * @param array $filters
     * @param int $limit
     * @return mixed
     */
    public function adGetLists($filters = [], $limit = 0);

    /**
     * @author : phi .
     * @param $id
     * @return mixed
     */
    public function getById($id);

    /**
     * @author : Phi .
     * @param array $data
     * @param Information $info
     * @return mixed
     */
    public function adUpdate($data = [], Information $info);

    /**
     * @author : Phi .
     * @param null $type
     * @return mixed
     */
    public function getDropDownBase($type = null);

    /**
     * @author : Phi .
     * @param array $data
     * @return mixed
     */
    public function apiGetInformation($data = []);
}
