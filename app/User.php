<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'updated_at', 'role_id', 'id'
    ];

    public function getBirthDateAttribute() {
        return Carbon::createFromFormat('Y-m-d', $this->attributes['birth_date'])->format('d-m-Y');
    }
    public function getCreatedAtAttribute() {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['created_at'])->format('d-m-Y');
    }

    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    /**
     * The rewards that belong to the user.
     */
    public function rewards()
    {
        return $this->hasMany('App\RewardUser');
    }
    /**
     * The favourites that belong to the user.
     */
    public function favouriteRewards()
    {
        return $this->belongsToMany('App\Reward', 'favourite_rewards');
    }

    public function favouriteEvents()
    {
        return $this->belongsToMany('App\Event', 'favourite_events');
    }

    public function hasRole($role)
    {
        if($this->role->name == $role) {
            return true;
        }
        return false;
    }
}
