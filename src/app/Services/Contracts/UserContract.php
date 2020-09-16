<?php
/**
 * Created by PhpStorm.
 * User: Phi
 * Date: 3/6/2020
 * Time: 10:59 AM
 */

namespace App\Services\Contracts;


use App\Http\Requests\UserRequest;
use App\Models\Member;

interface UserContract
{
    /**
     * @author : Phi .
     * @param array $filters
     * @param $limit
     * @return mixed
     */
    public function apiGetLists($filters = [], $limit = 0);

    /**
     * @author : Phi .
     * @param null $id
     * @return mixed
     */
    public function apiGetDetail($id = null);

    /**
     * @author : Phi .
     * @param UserRequest $request
     * @return mixed
     */
    public function apiInsert(UserRequest $request);

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
     * @author : Phi .
     * @param array $filters
     * @param int $limit
     * @return mixed
     */
    public function adGetActivityLists($filters = [], $limit = 0);

    /**
     * @author : phi .
     * @param $id
     * @return mixed
     */
    public function getById($id);

    /**
     * @author : Phi .
     * @param null $orgId
     * @return mixed
     */
    public function getDropDownBase($orgId = null);

    /**
     * @author : Phi .
     * @param array $data
     * @param Member $member
     * @return mixed
     */
    public function adUpdate($data = [], Member $member);
}
