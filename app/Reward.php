<?php

namespace App;

use Carbon\Carbon;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    protected $hidden = ['category_id', 'created_at', 'updated_at'];
    protected $appends = ['category', 'favourite'];

    public function getCategoryAttribute() {
        return $this->attributes['category'] = Category::find($this->attributes['category_id'])->name;
    }
    public function getFavouriteAttribute() {
        $token = JWTAuth::getToken();
        $tokenUser = JWTAuth::toUser($token);
        $result = false;
        foreach ($tokenUser->favouriteRewards as $reward) {
            if ($reward->id == $this->attributes['id']) {
                $result = true;
            }
        }
        return $result;
    }
    public function getEndDateAttribute() {
        return Carbon::createFromFormat('Y-m-d', $this->attributes['end_date'])->format('d-m-Y');
    }
    public function getExchangeDateAttribute() {
        if ($this->attributes['exchange_date'] != null)
            return Carbon::createFromFormat('Y-m-d', $this->attributes['exchange_date'])->format('d-m-Y');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    /**
     * The users that belong to the reward.
     */
    public function users()
    {
        return $this->hasMany('App\RewardUser');
    }

    /**
     * The users that belong to the reward.
     */
    public function favouritedBy()
    {
        return $this->belongsToMany('App\User', 'favourite_rewards');
    }
}
