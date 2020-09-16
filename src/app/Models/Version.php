<?php

namespace App\Models;

use App\Constants\Tables;
use Illuminate\Database\Eloquent\Model;

class Version extends Model
{
    /**
     * @var string
     */
    protected $table = Tables::Versions;

    /**
     * @var string
     */
    protected $primaryKey = 'version_id';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @author : Phi .
     * @param $query
     * @return mixed
     */
    public function scopeOrderByCreatedAtDesc($query)
    {
        return $query->orderBy($this->table . '.created_at', 'DESC');
    }
}
