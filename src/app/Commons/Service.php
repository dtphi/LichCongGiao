<?php
/**
 * Created by PhpStorm.
 * User: Phi
 * Date: 3/6/2020
 * Time: 10:44 AM
 */

namespace App\Commons;

use App\Http\Resources\Version\VersionResource;
use App\Models\Historie;
use App\Models\Version;
use Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;


class Service implements ServiceContract
{
    /**
     * @var array
     */
    public $errors = [];

    /**
     * @var null
     */
    public $version = null;

    /**
     * @author : Phi .
     * @param $name
     */
    public function adInsertLog($name = 'action')
    {
        // TODO: Implement adInsertLog() method.

        $user = Auth::user();
        if ($user) {
            $his          = new Historie();
            $his->user_id = $user->user_id;
            $his->action  = $name;
            $his->save();
        }
    }

    /**
     * @author : Phi .
     * @param null $id
     * @return VersionResource
     */
    public function apiCheckAppVersion()
    {
        // TODO: Implement apiGetDetail() method.
        $this->version = new Version();
        $query         = $this->version->select();
        $query->orderByCreatedAtDesc();

        $result = new VersionResource($query->first());

        return $result;
    }

    /**
     * @author : Phi .
     * @return mixed
     */
    public function getLastVersionByCreatedAt()
    {
        // TODO: Implement getLastVersionByCreatedAt() method.
        $this->version = new Version();

        $query = $this->version->select();

        $query->orderByCreatedAtDesc();

        return $query->first();
    }

    /**
     * @author : Phi .
     * @param array $data
     */
    public function adInsertVersion($data = [])
    {
        // TODO: Implement adInsertVersion() method.
        $version = new Version();

        $version->version    = $data['version'];
        $version->created_at = DB::raw('CURRENT_TIMESTAMP');

        $version->save();

        return $version;
    }

    /**
     * @author : Phi .
     * @param Collection $collection
     * @param int $limit
     * @return $this
     */
    public function chunkPaginator(Collection $collection, $limit = 20)
    {
        // TODO: Implement chunkPaginator() method.

        if ($collection->last()) {
            $totalCount = (($collection->count() - 1) * $limit) + $collection->last()->count();
        } else {
            $totalCount = 0;
        }

        $page = request('page', 1);
        $rows = $collection->get($page - 1);

        /**
         * $parameters = request()->getQueryString();
         * $parameters = preg_replace('/&page(=[^&]*)?|^page(=[^&]*)?&?/', '', $parameters);
         * $path = url(request()->getPathInfo() . '?' . $parameters);
         */

        $path        = url(request()->getPathInfo());
        $collections = new LengthAwarePaginator($rows, $totalCount, $limit, $page);

        return $collections->withPath($path);
    }

    /**
     * @author : Phi .
     * @return array
     */
    public function getDropOrg()
    {
        // TODO: Implement getDropOrg() method.
        $user = Auth::user();
        switch ($user->type) {
            case ConstantService::USER_TYPE_GUEST:
                if ($user->organization_id == ConstantService::ORG_3) {
                    return ConstantService::ASP_ORGS;
                }
                if ($user->organization_id == ConstantService::ORG_4) {
                    return ConstantService::UISM_ORGS;
                }

                break;
            case ConstantService::USER_TYPE_MEMBER:
                if ($user->organization_id == ConstantService::ORG_5) {
                    return ConstantService::MEMBER_ORGS_5;
                }
                if ($user->organization_id == ConstantService::ORG_6) {
                    return ConstantService::MEMBER_ORGS_6;
                }

                break;
        }

        return ConstantService::ORGS;
    }

    /**
     * @author : Phi .
     * @param array $options
     * @return array
     */
    public function getSettingUser($options = [])
    {
        // TODO: Implement getSettingUser() method.

        $config = [
            'organization.drop.down' => ConstantService::ORGS,
            'information.type'       => null,
            'base_id'                => null,
            'user.type'              => 1,
            'organization.list.show' => []
        ];

        $user = Auth::user();
        switch ($user->type) {
            case ConstantService::USER_TYPE_GUEST:
                if ($user->organization_id == ConstantService::ORG_3) {
                    $config['organization.drop.down'] = ConstantService::ASP_ORGS;
                    $config['information.type']       = ConstantService::BASE_TYPE_ASP;
                    $config['organization.list.show'] = ConstantService::LIST_ORG_GUEST_3_SHOW;
                }
                if ($user->organization_id == ConstantService::ORG_4) {
                    $config['organization.drop.down'] = ConstantService::UISM_ORGS;
                    $config['information.type']       = ConstantService::BASE_TYPE_UISM;
                    $config['organization.list.show'] = ConstantService::LIST_ORG_GUEST_4_SHOW;
                }

                break;
            case ConstantService::USER_TYPE_MEMBER:
                $config['base_id'] = $user->base_id;
                if ($user->organization_id == ConstantService::ORG_5) {
                    $config['organization.drop.down'] = ConstantService::MEMBER_ORGS_5;
                    $config['organization.list.show'] = ConstantService::LIST_ORG_MEMBER_5_SHOW;
                }
                if ($user->organization_id == ConstantService::ORG_6) {
                    $config['organization.drop.down'] = ConstantService::MEMBER_ORGS_6;
                    $config['organization.list.show'] = ConstantService::LIST_ORG_MEMBER_6_SHOW;
                }

                break;
        }

        if (isset($options['organization_id'])) {
            $orgId = (int)$options['organization_id'];

            $userType = 1;
            if ($orgId == 3 || $orgId == 4) {
                $userType = 2;
            }
            if ($orgId == 5 || $orgId == 6) {
                $userType = 3;
            }
            if ($orgId == 7 || $orgId == 8) {
                $userType = 4;
            }
            $config['user.type'] = $userType;
        }

        return $config;
    }

    /**
     * @author : Phi .
     * @param $path
     * @return string
     */
    public static function getS3Url($path)
    {
        $s3Cloud = \Illuminate\Support\Facades\Storage::cloud();
        $s3Url   = $s3Cloud->url($path);

        if ($s3Cloud->exists($path)) {
            return $s3Url;
        }

        return '';
    }
}
