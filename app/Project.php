<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model {

    protected $guarded = [];
    public $old = [];

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
        return $this->tasks()->create(['body' => $body, 'completed' => false]);
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
        $this->activity()->create([
            'description' => $description,
            'changes'     => $this->ActivityChanges($description)
        ]);
    }

    /**
     * @param $description
     * @return array
     */
    private function ActivityChanges($description)
    {
        if ($description === 'created_project')
        {
            return null;
        }
        else
        {
            return [
                'before' => array_diff($this->old, $this->getAttributes()),
                'after'  => array_diff($this->getAttributes(), $this->old),
            ];
        }

    }
}
