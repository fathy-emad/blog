<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    //

    protected  $fillable = [
        'user_id',
        'photo_id',
        'category_id',
        'title',
        'body'
    ];

    public function photo(){
        return $this->belongsTo('App\photo');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function comment(){
        return $this->hasMany('App\comment');
    }

    public function category(){
        return $this->belongsTo('App\category');
    }
}
