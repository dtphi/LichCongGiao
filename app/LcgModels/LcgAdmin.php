<?php

namespace App\LcgModels;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class LcgAdmin extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $guard = 'lcgadmin';

    protected $table = 'lcg_admin_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeFilterLikeName($query, $nameKana = '')
    {
        if (!empty($nameKana)) {
            return $query->where($this->table . '.name', 'LIKE', '%' . $nameKana . '%');
        }

        return $query;
    }
}
