<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //
    protected $directory = '/admin/images/';
    protected $fillable = ['path'];

    public function getPathAttribute($photo){
        return $this->directory . $photo;
    }

    public function post(){
        return $this->hasOne('App\post');
    }
}
