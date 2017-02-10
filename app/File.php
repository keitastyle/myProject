<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = ['author_id', 'task_id', 'title', 'link'];

    protected $dates = [
        'created_at', 'updated_at'
    ];

    public function author()
    {
        return $this->belongsTo('App\User');
    }

    public function task()
    {
        return $this->belongsTo('App\Task');
    }
}
