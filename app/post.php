<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    //

    protected  $fillable = [
        'user_id',
        'photo_id',
        'title',
        'body'
    ];

    public function photo(){
        return $this->belongsTo('App\photo');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
