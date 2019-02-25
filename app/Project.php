<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model {

    protected $guarded = [];

    public function path()
    {
        return "/projects/" . $this->id;
    }

    public function owner()
    {
        return $this->belongsTo('App\User');
    }

    public function addTask($body)
    {
        return $this->tasks()->create(['body'=>$body, 'completed'=>false]);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function activity()
    {
        return $this->hasMany('App\Activity')->latest();
    }


    public function recordActivity($description)
    {
       Activity::create([
           'project_id'=>$this->id,
           'description'=>$description
       ]);
    }
}
