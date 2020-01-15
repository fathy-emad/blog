<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    //

    protected $fillable = [
        'author',
        'comment',
        'comment_id',
        'photo_author_comment'
    ];

    public function comment(){
        return $this->belongsTo('App\comment');
    }
}
