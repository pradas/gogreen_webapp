<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class RewardUser extends Model
{
    protected $table = 'reward_user';

    protected $hidden = ['user_id', 'reward_id', 'created_at', 'updated_at'];
    protected $appends = ['title', 'points', 'category', 'end_date', 'exchange_date'];


    public function getTitleAttribute() {
        return Reward::find($this->attributes['reward_id'])->title;
    }
    public function getPointsAttribute() {
        return Reward::find($this->attributes['reward_id'])->points;
    }
    public function getCategoryAttribute() {
        return Reward::find($this->attributes['reward_id'])->category;
    }
    public function getEndDateAttribute() {
        return Reward::find($this->attributes['reward_id'])->end_date;
    }
    public function getExchangeDateAttribute() {
        return Reward::find($this->attributes['reward_id'])->exchange_date;
    }


    public function users()
    {
        return $this->belongsTo('App\User');
    }

    public function rewards()
    {
        return $this->belongsTo('App\Reward');
    }

}
