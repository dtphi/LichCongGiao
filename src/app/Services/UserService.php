<?php
/**
 * Created by PhpStorm.
 * User: Phi
 * Date: 3/6/2020
 * Time: 10:58 AM
 */

namespace App\Services;


use App\Commons\ConstantService;
use App\Commons\Service;
use App\Http\Requests\UserRequest;
use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\UserResource;
use App\Models\Member;
use App\Models\Historie;
use App\Services\Contracts\UserContract;
use Auth;

class UserService extends Service implements UserContract
{
    /**
     * @var User|null
     */
    private $user = null;

    private $history = null;

    /**
     * @var array
     */
    public $sorts = [
        'registDateDesc'  => '新着順',
        'nameKanaAsc'     => 'カナ順',
        'organizationAsc' => '組織順'
    ];

    /**
     * @author : Phi .
     * UserService constructor.
     */
    public function __construct()
    {
        $this->user = new Member();
        $this->history =new Historie();
    }

    /**
     * @author : Phi .
     * @param array $filters
     * @param int $limit
     * @return mixed
     */
    public function apiGetLists($filters = [], $limit = 0)
    {
        // TODO: Implement apiGetLists() method.

        $query = $this->user->orderByCreatedAtDesc();

        $results = new UserCollection($query->paginate($limit));

        return $results;
    }

    /**
     * @author : Phi .
     * @param null $id
     * @return UserResource
     */
    public function apiGetDetail($id = null)
    {
        // TODO: Implement apiGetDetail() method.
        $user = $this->user->find($id);

        $result = new UserResource($user);

        return $result;
    }

    /**
     * @author : Phi .
     * @param UserRequest $request
     * @return UserResource
     */
    public function apiInsert(UserRequest $request)
    {
        // TODO: Implement apiInsert() method.

        $data = $request->getFormData();
        $user = new Member();

        $user->name            = $data['name'];
        $user->email           = $data['email'];
        $user->name_kana       = $data['name_kana'];
        $user->password        = get_pass($data['password']);
        $user->organization_id = 1;
        $user->type            = 1;
        $user->status          = $data['status'];

        $user->save();

        return new UserResource($user);
    }

    /**
     * @author : Phi .
     * @param array $data
     * @return UserResource
     */
    public function adInsert($data = [])
    {
        // TODO: Implement adInsert() method.

        $config = $this->getSettingUser($data);
        $user   = new Member();

        $user->name            = $data['name_kana'];
        $user->email           = $data['email'];
        $user->name_kana       = $data['name_kana'];
        $user->password        = get_pass($data['password']);
        $user->organization_id = $data['organization_id'];
        $user->type            = $config['user.type'];

        $auth = Auth::user();
        if ($auth->type == 3) {
            $data['base_id'] = $auth->base_id;
        }

        $user->base_id = $data['base_id'];
        $user->status  = 1;

        $user->save();

        return $user;
    }

    /**
     * @author : Phi .
     * @param $query
     * @return mixed
     */
    public function registDateDesc(&$query)
    {
        return $query->orderByIdDesc();
    }

    /**
     * @author : Phi .
     * @param $query
     * @return mixed
     */
    public function nameKanaAsc(&$query)
    {
        return $query->orderByNameKanaAsc();
    }

    /**
     * @author : Phi .
     * @param $query
     * @return mixed
     */
    public function organizationAsc(&$query)
    {
        return $query->orderByOrganizationAsc();
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
        $query = $this->user->select()->filterMemberOrg();

        if (isset($filters['name_kana'])) {
            $query->filterLikeKana($filters['name_kana']);
        }
        if (isset($filters['email'])) {
            $query->filterLikeEmail($filters['email']);
        }
        if (isset($filters['organization_id'])) {
            $query->filterOrgById($filters['organization_id']);
        }
        if (isset($filters['base_id'])) {
            $query->filterBaseById($filters['base_id']);
        }

        if (isset($filters['sort']) && array_key_exists($filters['sort'], $this->sorts)) {
            $this->{$filters['sort']}($query);
        }
        if (isset($filters['exam_id'])) {
            if (isset($filters['pass'])) {
                $query->lJoinUserExams($filters['exam_id'], $filters['pass']);
            } else {
                $query->lJoinUserExams($filters['exam_id']);
            }
        }

        if ($limit) {
            return $query->paginate($limit);
        }

        return $query;
    }

    /**
     * @author : Phi .
     * @param array $filters
     * @param int $limit
     * @return mixed
     */
    public function adGetActivityLists($filters = [], $limit = 0)
    {
        // TODO: Implement adGetActivityLists() method.

        $query = $this->history->select()->orderByCreatedAtDesc();

        if (isset($filters['user_id'])) {
            $query->filterByUserId($filters['user_id']);
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
        return $this->user->filterMemberOrg()->findOrFail($id);
    }

    /**
     * @author : Phi .
     * @param null $orgId
     * @return mixed
     */
    protected function _getDropDownBase($orgId = null)
    {
        // TODO: Implement getDropDownBase() method.

        $type = '';

        if ($orgId == ConstantService::ORG_5 || $orgId == ConstantService::ORG_7) {
            $type = ConstantService::BASE_TYPE_ASP;
        } elseif ($orgId == ConstantService::ORG_6 || $orgId == ConstantService::ORG_8) {
            $type = ConstantService::BASE_TYPE_UISM;
        }
        /*if ($type) {
            $query = $this->base->filterOrg()->filterType($type)->select();
        } else {
            $query = $this->base->filterOrg()->select();
        }*/

        return [];
    }

    /**
     * @author : Phi .
     * @param null $orgId
     * @return mixed
     */
    public function getDropDownBase($orgId = null)
    {
        // TODO: Implement getDropDownBase() method.

        $type = '';

        if ($orgId == ConstantService::ORG_5 || $orgId == ConstantService::ORG_7) {
            $type = ConstantService::BASE_TYPE_ASP;
        } elseif ($orgId == ConstantService::ORG_6 || $orgId == ConstantService::ORG_8) {
            $type = ConstantService::BASE_TYPE_UISM;
        }

        /*$bsSv  = new BaseService();
        $query = $bsSv->adGetList(0, ['type' => $type]);*/

        return [];
    }

    /**
     * @author : Phi .
     * @param array $data
     * @param Member $member
     */
    public function adUpdate($data = [], Member $member)
    {
        // TODO: Implement adUpdate() method.

        $config = $this->getSettingUser($data);

        if ($member instanceof Member && !empty($data)) {
            $member->name_kana = $data['name_kana'];
            $member->email     = $data['email'];
            if (!empty($data['password'])) {
                $member->password = get_pass($data['password']);
            }
            $member->type            = $config['user.type'];
            $member->organization_id = $data['organization_id'];
            $member->base_id         = $data['base_id'];
            $member->status          = $data['status'];

            $member->save();
        }
    }
}
