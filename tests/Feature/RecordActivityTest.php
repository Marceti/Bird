<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RecordActivityTest extends TestCase {

    use RefreshDatabase;

    /** @test */
    public function creating_a_project()
    {
        //Given
        $project = factory('App\Project')->create();

        //Then
        $this->assertCount(1, $project->activity);
        $this->assertEquals('created_project', $project->activity->last()->description);
    }

    /** @test */
    public function updating_a_project()
    {
        //Given
        $project = factory('App\Project')->create();

        //When
        $project->update(['description' => 'updated']);

        //Then
        $this->assertCount(2, $project->activity);
        $this->assertEquals('updated_project', $project->activity->last()->description);
    }

    /** @test */
    public function creating_a_task()
    {
        //Given
        $project = factory("App\Project")->create();

        //When
        $project->addTask('NewTask');

        //Then
        $this->assertCount(2, $project->activity);
        $this->assertEquals('created_task', $project->activity->last()->description);
    }

    /** @test */
    public function completing_a_task_records_activity()
    {
        //Given
        $project = factory("App\Project")->create();

        //When
        $task = $project->addTask('NewTask');


        $this->assertFalse($task->completed);


        $this->actingAs($project->owner);
        $this->patch($task->path(), ['body' => $task->body, 'completed' => true]);

        //Then

        $this->assertTrue($task->fresh()->completed);

        $this->assertCount(3, $project->activity);
        $this->assertEquals('completed_task', $project->activity->last()->description);
    }

    /** @test */
    public function incompleting_a_task_records_activity()
    {
        //Given
        $project = factory("App\Project")->create();

        //When
        $task = $project->addTask('NewTask');


        $this->assertFalse($task->completed);


        $this->actingAs($project->owner);
        $this->patch($task->path(), ['body' => $task->body, 'completed' => true]);
        $this->patch($task->path(), ['body' => $task->body]);

        //Then

        $this->assertFalse($task->fresh()->completed);
        $this->assertCount(4, $project->activity);
        $this->assertEquals('incompleted_task', $project->activity->last()->description);
    }


}
