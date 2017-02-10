<?php

namespace App;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    protected $fillable=[
        'project_id','location','date','status'
    ];

    protected $dates=['created_at','updated_at','date'];

    public function setDateAttribute($value){
        $this->attributes['date']=Carbon::createFromFormat('d/m/Y',$value);
    }

    public function project(){
        return $this->belongsTo('App\Project');
    }

    public function students(){
        return $this->belongsToMany('App\Student');
    }

}
