<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $hidden = ['created_at', 'updated_at', 'category_id'];
    protected $appends = ['category', 'time'];

    public function getCategoryAttribute() {
        return $this->attributes['category'] = Category::find($this->attributes['category_id'])->name;
    }
    public function getDateAttribute() {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['date'])->format('d-m-Y');
    }
    public function getTimeAttribute() {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['date'])->format('H:i');
    }

    public function category() {
        return $this->belongsTo('App\Category');
    }

}
