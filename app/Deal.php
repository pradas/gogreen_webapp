<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Facades\JWTAuth;

class Deal extends Model
{
    protected $hidden = ['created_at', 'updated_at'];
    protected $appends = ['favourite', 'shop'];

    public function getFavouriteAttribute() {
        $token = JWTAuth::getToken();
        $tokenUser = JWTAuth::toUser($token);
        $result = false;
        foreach ($tokenUser->favouriteDeals as $deal) {
            if ($deal->id == $this->attributes['id']) {
                $result = true;
            }
        }
        return $result;
    }
    public function getShopAttribute()
    {
        return Shop::find($this->attributes['shop_id'])->name;
    }

    public function shop(){
        return $this->belongsTo('App\Shop');
    }

    public function favouritedBy()
    {
        return $this->belongsToMany('App\User', 'favourite_deals');
    }

}
