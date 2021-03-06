<?php

namespace App\Observers;

use App\Task;

class TaskObserver
{
    /**
     * Handle the task "created" event.
     *
     * @param  \App\Task $task
     * @return void
     */
    public function created(Task $task)
    {
        $task->recordActivity('created_task');
    }

    /**
     * Handle the task "updated" event.
     *
     * @param  \App\Task $task
     * @return void
     */
    public function updated(Task $task)
    {
        if ($task->fresh()->completed) {
            $task->recordActivity('completed_task');
        } else {
            $task->recordActivity('incompleted_task');
        }
    }

    /**
     * Handle the task "deleted" event.
     *
     * @param  \App\Task $task
     * @return void
     */
    public function deleted(Task $task)
    {
        //
    }

    /**
     * Handle the task "restored" event.
     *
     * @param  \App\Task $task
     * @return void
     */
    public function restored(Task $task)
    {
        //
    }

    /**
     * Handle the task "force deleted" event.
     *
     * @param  \App\Task $task
     * @return void
     */
    public function forceDeleted(Task $task)
    {
        //
    }
}
