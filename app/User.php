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
        'name', 'email', 'password', 'username', 'role_id', 'image'
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

    public function manages()
    {
        return $this->hasOne('App\Shop');
    }

    /**
     * The rewards that belong to the user.
     */
    public function rewards()
    {
        return $this->hasMany('App\RewardUser');
    }

    public function works(){
        return $this->belongsTo('App\Shop');
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

    public function favouriteDeals()
    {
        return $this->belongsToMany('App\Deal', 'favourite_deals');
    }

    public function hasRole($role)
    {
        if($this->role->name == $role) {
            return true;
        }
        return false;
    }
}
