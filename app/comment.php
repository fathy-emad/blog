<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    //
    protected $fillable = [
        'author',
        'comment',
        'post_id',
        'photo_author_comment'
    ];

    public function post(){
        return $this->belongsTo('App\post');
    }

    public function reply(){
        return $this->hasMany('App\Reply');
    }
}
