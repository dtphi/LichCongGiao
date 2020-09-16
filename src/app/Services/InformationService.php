<?php
/**
 * Created by PhpStorm.
 * User: Phi
 * Date: 3/6/2020
 * Time: 10:58 AM
 */

namespace App\Services;


use App\Commons\Service;
use App\Constants\Tables;
use App\Http\Resources\Information\InformationCollection;
use App\Models\Information;
use App\Models\Member;
use App\Services\Contracts\InformationContract;
use Illuminate\Http\Resources\MissingValue;
use Validator;

class InformationService extends Service implements InformationContract
{

    /**
     * @var Information|null
     */
    private $infomation = null;

    /**
     * @var Member|null
     */
    private $member = null;

    /**
     * @author : Phi .
     * UserService constructor.
     */
    public function __construct()
    {
        $this->infomation = new Information();
        $this->member     = new Member();
    }

    /**
     * @author : Phi .
     * @param array $data
     * @return UserResource
     */
    public function adInsert($data = [])
    {
        // TODO: Implement adInsert() method.

        $info = new Information();

        $info->type            = $data['type'];
        $info->base_id         = $data['base_id'];
        $info->info_title      = $data['info_title'];
        $info->info_contents   = $data['info_contents'];
        $info->disp_start_date = $data['disp_start_date'];
        $info->disp_end_date   = $data['disp_end_date'];

        $info->save();

        return $info;
    }

    /**
     * @author : Phi .
     * @param $query
     * @return mixed
     */
    public function registDateDesc(&$query)
    {
        return $query->orderByCreatedAtDesc();
    }

    /**
     * @author : Phi .
     * @param array $filters
     * @param int $limit
     * @return mixed
     */
    public function adGetLists($filters = [], $limit = 0)
    {
        // TODO: Implement adGetLists() method.

        $query = $this->infomation->select();

        $config = $this->getSettingUser();
        if ($config['information.type']) {
            $query->filterOrg($config['information.type']);
        }

        if (isset($filters['status'])) {
            $query->filterStatus($filters['status']);
        }

        if ($limit) {
            return $query->paginate($limit);
        }

        return $query;
    }

    /**
     * @author : Phi .
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        $config = $this->getSettingUser();
        if ($config['information.type']) {
            return $this->infomation->filterOrg($config['information.type'])
            ->findOrFail($id);
        }

        return $this->infomation->findOrFail($id);
    }

    /**
     * @author : Phi .
     * @param array $data
     * @param Information $info
     */
    public function adUpdate($data = [], Information $info)
    {
        // TODO: Implement adUpdate() method.

        if ($info instanceof Information && !empty($data)) {
            $info->type            = $data['type'];
            $info->base_id         = $data['base_id'];
            $info->info_title      = $data['info_title'];
            $info->info_contents   = $data['info_contents'];
            $info->disp_start_date = $data['disp_start_date'];
            $info->disp_end_date   = $data['disp_end_date'];

            $info->save();
        }
    }

    /**
     * @author : Phi .
     * @param null $type
     * @return mixed
     */
    public function getDropDownBase($type = null)
    {
        // TODO: Implement getDropDownBase() method.

        /*$base = new Base();

        if ($type) {
            $query = $base->filterType($type)->select();
        } else {
            $query = $base->select();
        }*/

        return [];
    }

    /**
     * @author : Phi .
     * @param array $data
     * @return bool
     */
    public function apiGetInformation_($data = [])
    {
        // TODO: Implement apiGetInformation() method.

        $user = $this->member->filterId($data['user_id'])->first();

        if ($user) {
            $results    = $this->infomation->select()
                ->filterType($user->type)
                ->filterBaseIdOrNull($data['base_id'])
                ->orderByIdDesc()->get();

            $collection = new InformationCollection($results, [
                'type'    => $user->type,
                'base_id' => $user->base_id
            ]);

            return $collection;
        }

        return new InformationCollection(new MissingValue());
    }

    /**
     * @author : Phi .
     * @param array $data
     * @return bool
     */
    public function apiGetInformation($data = [])
    {
        // TODO: Implement apiGetInformation() method.

        $user = $this->member->select([Tables::Users.'.*'])
            ->lJoinBase()
            ->filterBaseById($data['base_id'])
            ->filterId($data['user_id'])->first();

        if ($user) {
            $results    = $this->infomation->select()
                ->filterType($user->base_type)
                ->filterBaseIdOrNull($user->base_id)
                ->orderByIdDesc()->get();
            $collection = new InformationCollection($results, [
                'type'    => $user->type,
                'base_id' => $user->base_id
            ]);

            return $collection;
        }

        return new InformationCollection(new MissingValue());
    }
}
