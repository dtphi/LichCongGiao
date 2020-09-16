<?php

namespace App\Models;

use App\Constants\Tables;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\MailResetPasswordNotification;
use Laravel\Passport\HasApiTokens;

class Admin extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * @var string
     */
    protected $table = Tables::Users;

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
        'last_login_date'
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
     * @author : Phi .
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
        return $this->belongsTo('App\Models\Base', 'base_id');
    }

    /**
     * @author : Phi .
     * Send the password reset notification.
     *
     * @param  string $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MailResetPasswordNotification($token));
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
}
