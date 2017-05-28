<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'address', 'image', 'user_id'
    ];

    protected $hidden = ['created_at', 'updated_at'];

    public function manager()
    {
        return  $this->belongsTo('App\User');
    }
    public function employees()
    {
        return $this->hasMany('App\User');
    }
    public function deals()
    {
        return $this->hasMany('App\Deal');
    }
    public function events()
    {
        return $this->hasMany();
    }

}
