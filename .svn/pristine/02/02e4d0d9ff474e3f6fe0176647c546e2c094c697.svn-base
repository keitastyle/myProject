<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends model
{
    protected $fillable = [
        'affiliation', 'grade', 'field', 'project_id'
    ];

    public function user(){
        return $this->morphOne('App\User','userable');
    }

    public function project(){
        return $this->belongsTo('App\Project');
    }

    public function meetings(){
        return $this->belongsToMany('App\Meeting');
    }


}
