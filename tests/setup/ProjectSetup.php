<?php
/**
 * Created by PhpStorm.
 * User: marce
 * Date: 08.02.2019
 * Time: 13:22
 */

namespace Tests\setup;


use App\Project;
use App\Task;
use App\User;

class ProjectSetup {

    protected $taskCount = 0;

    protected $user;

    public function withTasks($count)
    {
        $this->taskCount = $count;
        return $this;
    }

    public function create()
    {
        /** Creaza un proiect | care apartine unui anumit user */
        $project = factory(Project::class)->create(
            ['owner_id' => $this->user ?? factory(User::class)->create()->id]
        );

        /** Creaza un numar de task-uri pentru acest proiect | default numarul de task-uri este 0 */
        factory(Task::class, $this->taskCount)->create(['project_id' => $project->id]);

        return $project;
    }

    public function ownedBy($user)
    {
        $this->user =$user;

        return $this;
    }
}