<?php

namespace Tests\Unit;

use App\Task;
use App\Project;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_a_path()
    {
        //Given
        $project = factory('App\Project')->create();
        $task = factory('App\Task')->create(['project_id' => $project->id]);

        //Then
        $this->assertEquals('/projects/'.$project->id.'/tasks/'.$task->id, $task->path());
    }

    /** @test */
    public function it_belongs_to_a_project()
    {
        //Given
        $task = factory(Task::class)->create();

        //Then

        $this->assertInstanceOf(Project::class, $task->project);
    }

    /** @test */
    public function it_can_be_completed()
    {
        //Given
        $task = factory(Task::class)->create(['completed'=>false]);

        //When
        $this->assertFalse($task->completed);

        $task->complete();

        //Then
        $this->assertTrue($task->fresh()->completed);
    }

    /** @test */
    public function it_can_be_incompleted()
    {
        //Given
        $task = factory(Task::class)->create(['completed'=>true]);

        //When
        $this->assertTrue($task->completed);

        $task->incomplete();

        //Then
        $this->assertFalse($task->fresh()->completed);
    }
}
