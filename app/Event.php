<?php

namespace App;

use Carbon\Carbon;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $hidden = ['created_at', 'updated_at', 'category_id'];
    protected $appends = ['category', 'favourite'];

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

    /**
     * The users that belong to the reward.
     */
    public function favouritedBy()
    {
        return $this->belongsToMany('App\User', 'favourite_events');
    }

}
