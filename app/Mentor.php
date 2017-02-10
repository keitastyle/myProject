<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mentor extends Model
{
    protected $fillable = [
        'domain'
    ];

    public function projects(){
        return $this->hasMany('App\Project');
    }

    public function user(){
        return $this->morphOne('App\User','userable');
    }


}
