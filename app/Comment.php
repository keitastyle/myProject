<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $fillable = ['author_id', 'title',  'content', 'of_id', 'of_type'];

    protected $dates = ['created_at', 'updated_at'];

    public function author() {
        return $this->belongsTo('App\User');
    }

    public function commentable(){
        return $this->morphTo();
    }

}
