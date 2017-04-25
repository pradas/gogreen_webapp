<?php

namespace App;

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
        'password', 'remember_token', 'updated_at', 'role_id', 'birth_date', 'id'
    ];

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

    public function hasRole($role)
    {
        if($this->role->name == $role) {
            return true;
        }
        return false;
    }
}
