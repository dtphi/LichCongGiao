<?php

namespace App\Models;

use App\Commons\BaseModel as Model;
use App\Constants\Tables;

class Historie extends Model
{
    /**
     * @var string
     */
    protected $table = Tables::Histories;

    /**
     * @var string
     */
    protected $primaryKey = 'history_id';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * Disable soft deletes for this model
     */
    public static function bootSoftDeletes() {}

    /**
     * @author : Phi .
     * @param $query
     * @param null $userId
     * @return mixed
     */
    public function scopeFilterByUserId($query, $userId = null)
    {
        if (!is_null($userId)) {
            return $query->where($this->table . '.user_id', $userId);
        }

        return $query;
    }
}
