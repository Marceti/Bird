<?php

namespace Tests\Feature;

use App\Task;
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
    public function creating_a_project_has_no_changes()
    {
        //Given
        $project = factory('App\Project')->create();

        //Then
        $this->assertNull($project->activity->last()->changes);
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
    public function updating_a_project_records_changes_on_field()
    {
        //Given
        $project = factory('App\Project')->create([
            'title' =>'Initial Title',
            'description'=>'some description',
        ]);

        //When
        $project->update(['description' => 'updated']);

        //Then

        $changes=[
            'before'=>[
                'description'=>'some description'
            ],
            'after'=>[
                'description' => 'updated'
            ],
        ];

        $this->assertEquals($changes, $project->activity->last()->changes);
    }

    /** @test */
    public function updating_a_project_records_changes_on_all_fields()
    {
        //Given
        $project = factory('App\Project')->create([
            'title' =>'Initial Title',
            'description'=>'some description',
        ]);

        //When
        $project->update([
            'title' =>'Modified Title',
            'description' => 'updated'
        ]);

        //Then

        $changes=[
            'before'=>[
                'title' =>'Initial Title',
                'description'=>'some description',
            ],
            'after'=>[
                'title' =>'Modified Title',
                'description' => 'updated'
            ],
        ];

        $this->assertEquals($changes, $project->activity->last()->changes);
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
        $this->assertInstanceOf(Task::class, $project->activity->last()->subject);


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
        $this->assertInstanceOf(Task::class, $project->activity->last()->subject);
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
        $this->assertInstanceOf(Task::class, $project->activity->last()->subject);
    }


}
