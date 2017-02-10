<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Historic extends Model
{
    protected $fillable = ['author_id','project_id','content'];

    protected $dates = ['created_at', 'updated_at'];

    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public function author()
    {
        return $this->belongsTo('App\User');
    }
}
