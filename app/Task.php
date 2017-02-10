<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['project_id', 'author_id', 'title', 'description', 'beginning_date', 'ending_date', 'status'];

    protected $dates = [
        'beginning_date', 'ending_date', 'created_at', 'updated_at'
    ];

    public function setBeginningDateAttribute($value)
    {
        $this->attributes['beginning_date'] = Carbon::createFromFormat('d/m/Y', $value);
    }

    public function setEndingDateAttribute($value)
    {
        $this->attributes['ending_date'] = Carbon::createFromFormat('d/m/Y', $value);
    }

    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public function author()
    {
        return $this->belongsTo('App\Student');
    }
    public function comments(){
        return $this->morphMany('App\Comment', 'of');
    }

    public function files ()
    {
        return $this ->hasMany('App\File');
    }

    public function getStatus()
    {
        if ($this->attributes['status'] == '1') {
            return '<span class="label label-primary">En cours...</span>';
        }
        if ($this->attributes['status'] == '2') {
            return '<span class="label label-info">En attente de validation...</span>';
        }
        if ($this->attributes['status'] == '3') {
            return '<span class="label label-success">Terminé</span>';
        }
        return '<span class="label label-warning">Ambigüe</span>';
    }
}