<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * @var string
     */
    protected $primaryKey = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'name_kana',
        'email',
        'password',
        'organization_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function exams()
    {
        return null;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function base()
    {
        return null;
    }

    /**
     * @author : Phi .
     * @param $value
     * @return mixed
     */
    public function getBaseNameAttribute($value)
    {
        if (!is_null($this->base)) {
            $value = $this->base->base_name;
        }

        return $value;
    }

    /**
     * @author : Phi .
     * @return array
     */
    public function getJson()
    {
        $user = [
            'user_id'         => $this->user_id,
            'name_kana'       => $this->name_kana,
            'email'           => $this->email,
            'organization_id' => $this->organization_id,
            'type'            => $this->type,
            'base_id'         => $this->base_id,
            'base_name'       => $this->base_name,
            'status'          => $this->status,
            'last_login_date' => $this->last_login_date
        ];

        return $user;
    }
}
