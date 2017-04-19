<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RewardUser extends Model
{
    protected $table = 'reward_user';
    protected $appends = ['category'];

    public function users()
    {
        return $this->belongsTo('App\User');
    }

    public function rewards()
    {
        return $this->belongsTo('App\Reward');
    }

}
