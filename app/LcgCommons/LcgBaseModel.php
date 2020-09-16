<?php
/**
 * Created by PhpStorm.
 * User: Phi
 * Date: 3/6/2020
 * Time: 10:38 AM
 */

namespace App\LcgCommons;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;


class LcgBaseModel extends Model
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
