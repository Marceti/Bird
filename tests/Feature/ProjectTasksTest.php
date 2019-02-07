<?php

namespace Tests\Feature;

use App\Project;
use App\Task;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTasksTest extends TestCase {

    use RefreshDatabase;

    /** @test */
    public function a_project_can_have_tasks()
    {
        $this->withoutExceptionHandling();
        //Given
        $this->signIn();
        $project = factory('App\Project')->create(['owner_id' => auth()->id()]);

        //When
        $this->post($project->path() . '/tasks', ['body' => 'Lorem ipsum !!!']);

        //Then

        $response = $this->get($project->path());
        $response->assertSee('Lorem ipsum !!!');
    }

    /** @test */
    public function a_task_must_have_a_body()
    {
        //Given
        $this->signIn();
        $project = factory('App\Project')->create(['owner_id' => auth()->id()]);
        $attributes = factory('App\Task')->raw(['body' => '']);
        //When

        $response = $this->post($project->path() . '/tasks', $attributes);

        //Then

        $response->assertSessionHasErrors('body');

    }

    /** @test */
    public function only_the_owner_of_a_project_can_add_tasks()
    {
        //Given
        $this->signIn();
        $project = factory('App\Project')->create();

        //When
        $response = $this->post($project->path() . '/tasks', ['body' => 'Lorem ipsum !!!']);

        //Then
        $response->assertStatus(403);
        $this->assertDatabaseMissing('tasks', ['body' => 'Lorem ipsum !!!']);

    }

    /** @test */
    public function only_the_owner_of_a_project_may_add_tasks()
    {
        //Given
        $this->signIn();
        $project = factory('App\Project')->create();
        $task=$project->addTask('Test Task 5');

        //When
        $response = $this->patch($task->path() , ['body' => 'Test Task 10']);

        //Then
        $response->assertStatus(403);
        $this->assertDatabaseMissing('tasks', ['body' => 'Test Task 10']);

    }

    /** @test */
    public function a_task_can_be_edited()
    {
        $this->withoutExceptionHandling();
        //Given
            $this->signIn();
            $project = auth()->user()->projects()->create(factory(Project::class)->raw());
            $task = $project->addTask('Something');

        //When
        $response = $this->patch($task->path(), [
            'body'      => 'Something new',
            'completed' => true,
        ]);

        //Then
        $response = $this->assertDatabaseHas('tasks', [
            'body'      => 'Something new',
            'completed' => true
        ]);
    }
    

}
