<?php
/**
 * Created by PhpStorm.
 * User: Phi
 * Date: 3/6/2020
 * Time: 10:38 AM
 */

namespace App\Commons;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;


class BaseModel extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    public $timeFormat = 'H:m';

    /**
     * @author : Phi .
     * @param $query
     * @return mixed
     */
    public function scopeOrderByCreatedAtDesc($query)
    {
        return $query->orderBy($this->table . '.created_at', 'DESC');
    }

    /**
     * @author : Phi .
     * @param $query
     * @return mixed
     */
    public function scopeOrderByIdDesc($query)
    {
        return $query->orderBy($this->table . '.' . $this->primaryKey, 'DESC');
    }

    /**
     * @author : Phi .
     * @param $query
     * @return mixed
     */
    public function scopeOrderByIdAsc($query)
    {
        return $query->orderBy($this->table . '.' . $this->primaryKey, 'ASC');
    }

    /**
     * @author : Phi .
     * @param $value
     * @return string
     */
    public function getLastLoginDateTextAttribute($value)
    {
        $value = [
            'date' => '',
            'time' => ''
        ];
        if ($this->last_login_date) {
            $value['date'] = date_ymd_hms($this->last_login_date);
            $value['time'] = date_ymd_hms($this->last_login_date, $this->timeFormat);
        }

        return $value;
    }

    /**
     * @author : Phi .
     * @param $value
     * @return array
     */
    public function getCreatedAtDateTextAttribute($value)
    {
        $value = [
            'date' => '',
            'time' => ''
        ];
        if ($this->created_at) {
            $value['date'] = date_ymd_hms($this->created_at, 'Y-m-d');
            $value['time'] = date_ymd_hms($this->created_at, 'H:m:s');
        }

        return $value;
    }

    /**
     * @author : Phi .
     * @return bool
     */
    public function isAdminType()
    {
        // TODO: Implement isAdminType() method.

        if (Auth::user()->type == ConstantService::USER_TYPE_ADMIN) {
            return true;
        }

        return false;
    }

    /**
     * @author : Phi .
     * @param $query
     * @return mixed
     */
    public function scopeOrderByNameKanaAsc($query)
    {
        return $query->orderBy($this->table . '.name_kana', 'ASC');
    }

    /**
     * @author : Phi .
     * @param $query
     * @return mixed
     */
    public function scopeOrderByOrganizationAsc($query)
    {
        return $query->orderBy($this->table . '.organization_id', 'ASC');
    }

    /**
     * @author : Phi .
     * @param $query
     * @param null $orgId
     * @return mixed
     */
    public function scopeOrgGuest($query, $orgId = null)
    {
        if ($orgId == ConstantService::ORG_3) {
            return $query->whereIn($this->table . '.organization_id' , ConstantService::LIST_ORG_GUEST_3_SHOW);
        }
        if ($orgId == ConstantService::ORG_4) {
            return $query->whereIn($this->table . '.organization_id' , ConstantService::LIST_ORG_GUEST_4_SHOW);
        }
    }

    /**
     * @author : Phi .
     * @param $query
     * @return mixed
     */
    public function scopeOrgType3($query)
    {
        return $query->where($this->table . '.organization_id', ConstantService::ORG_5)
            ->orWhere($this->table . '.organization_id', ConstantService::ORG_6);
    }

    /**
     * @author : Phi .
     * @param $query
     * @param null $orgId
     * @param $base_id
     * @return mixed
     */
    public function scopeOrgMember($query, $orgId = null, $base_id) {
        $query->filterBaseById($base_id);
        $query->filterMemberType();
        if ($orgId == ConstantService::ORG_5) {
            return $query->whereIn($this->table . '.organization_id' , ConstantService::LIST_ORG_MEMBER_5_SHOW);
        }
        if ($orgId == ConstantService::ORG_6) {
            return $query->whereIn($this->table . '.organization_id' , ConstantService::LIST_ORG_MEMBER_6_SHOW);
        }
    }

    /**
     * @author : Phi .
     * @param $query
     * @return mixed
     */
    public function scopeFilterMemberOrg($query)
    {
        $user = Auth::user();

        switch ($user->type) {
            case ConstantService::USER_TYPE_GUEST:
                $query->orgGuest($user->organization_id);

                break;
            case ConstantService::USER_TYPE_MEMBER:
                $query->orgMember($user->organization_id, $user->base_id);

                break;
        }

        return $query;
    }

    /**
     * @author : Phi .
     * @param $query
     * @param string $id
     * @return mixed
     */
    public function scopeFilterId($query, $id = '')
    {
        if (!empty($id)) {
            return $query->where($this->table . '.' . $this->primaryKey, $id);
        }

        return $query;
    }
}
