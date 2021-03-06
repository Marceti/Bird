<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $guarded = [];

    protected $touches = ['project'];

    protected $casts = ['completed'=>'boolean'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function path()
    {
        return $this->project->path().'/tasks/'.$this->id;
    }

    /**
     * Set the task to complete.
     */
    public function complete()
    {
        $this->update(['completed'=>true]);
    }

    /**
     *Set the task to incomplete.
     */
    public function incomplete()
    {
        $this->update(['completed'=>false]);
    }

    public function activity()
    {
        return $this->morphMany('App\Activity', 'subject')->latest();
    }

    public function recordActivity($description)
    {
        $this->activity()->create([
            'description'=>$description,
            'project_id'=>$this->project->id,
        ]);
    }
}
