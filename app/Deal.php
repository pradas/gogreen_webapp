<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    protected $hidden = ['created_at', 'updated_at'];
    protected $appends = ['favourite'];

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

    public function shop(){
        return $this->belongsTo('App\Shop');
    }

    public function favouritedBy()
    {
        return $this->belongsToMany('App\User', 'favourite_deals');
    }

}
