<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    //

    protected $fillable = ['post_id','name'];

    public function post(){
        return $this->hasMany('App\post');
    }
}
