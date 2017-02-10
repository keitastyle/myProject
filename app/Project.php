<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Project extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'mentor_id', 'title', 'type','theme', 'description', 'location', 'beginning_date', 'ending_date', 'status'
    ];

    protected $dates = [
        'beginning_date', 'ending_date', 'created_at', 'updated_at', 'deleted_at'
    ];

    public function setBeginningDateAttribute($value){
        $this->attributes['beginning_date'] = Carbon::createFromFormat('d/m/Y', $value);
    }

    public function setEndingDateAttribute($value){
        $this->attributes['ending_date'] = Carbon::createFromFormat('d/m/Y', $value);
    }

    public function mentor()
    {
        return $this->belongsTo('App\Mentor');
    }

    public function students(){
        return $this->hasMany('App\Student');
    }

    public function tasks(){
        return $this->hasMany('App\Task');
    }

    public function comments(){
        return $this->morphMany('App\Comment', 'of');
    }
    public function meetings(){
        return $this->hasMany('App\Meeting');
	}

    public function historics()
    {
        return $this->hasMany('App\Historic');
    }
    public function getStatus()
    {
        if ($this->attributes['status'] == '1') {
            return '<span class="label label-primary">En cours...</span>';
        }
        if ($this->attributes['status'] == '3') {
            return '<span class="label label-success">Terminé</span>';
        }
        if ($this->attributes['status'] == '2') {
            return '<span class="label label-warning">Annulé</span>';
        }
        return '<span class="label label-warning">Ambigüe</span>';
    }
}
