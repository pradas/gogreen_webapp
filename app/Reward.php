<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    protected $hidden = ['category_id', 'created_at', 'updated_at'];
    protected $appends = ['category'];

    public function getCategoryAttribute() {
        return $this->attributes['category'] = Category::find($this->category_id)->name;
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
