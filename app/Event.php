<?php

namespace App;

use Carbon\Carbon;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $hidden = ['created_at', 'updated_at', 'category_id'];
    protected $appends = ['category', 'favourite', 'shop'];

    public function getCategoryAttribute() {
        return $this->attributes['category'] = Category::find($this->attributes['category_id'])->name;
    }
    public function getFavouriteAttribute() {
        $token = JWTAuth::getToken();
        $tokenUser = JWTAuth::toUser($token);
        $result = false;
        foreach ($tokenUser->favouriteEvents as $event) {
            if ($event->id == $this->attributes['id']) {
                $result = true;
            }
        }
        return $result;
    }
    public function getShopAttribute()
    {
        return Shop::find($this->attributes['shop_id'])->name;
    }


    //Al final victor no quiere la fecha dividida
    /*
    public function getDateAttribute() {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['date'])->format('d-m-Y');
    }
    public function getTimeAttribute() {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['date'])->format('H:i');
    }
    */

    public function category() {
        return $this->belongsTo('App\Category');
    }

    public function shop(){
        return $this->belongsTo('App\Shop');
    }

    /**
     * The users that belong to the reward.
     */
    public function favouritedBy()
    {
        return $this->belongsToMany('App\User', 'favourite_events');
    }

}
