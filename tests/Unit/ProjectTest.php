<?php

namespace Tests\Unit;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTest extends TestCase {

    use RefreshDatabase;

    /** @test */
    public function a_project_has_a_path()
    {
        //Given
        $project = factory('App\Project')->create();

        //Then
        $this->assertEquals('/projects/' . $project->id, $project->path());
    }


    /** @test */
    public function a_project_belongs_to_an_owner()
    {
        //Given
        $user = factory('App\User')->create();
        $project = factory('App\Project')->create(['owner_id' => $user->id]);

        //Then
        $this->assertInstanceOf(Model::class, $project->owner);
        $this->assertEquals($project->owner->id, $user->id);
    }

    /** @test */
    public function it_can_add_a_task()
    {
        //Given
        $project = factory('App\Project')->create();

        //When
        $project->addTask('Test Task 1');

        //Then
        $this->assertCount(1, $project->tasks);
        $this->assertEquals('Test Task 1', $project->tasks->first()->body);
    }

    /** @test */
    public function it_has_activity_feed()
    {
        //Given
        $project = factory('App\Project')->create();

        //Then
        $this->assertInstanceOf(Collection::class, $project->activity);

    }

    /** @test */
    public function can_record_activity()
    {
        //Given
        $project = factory('App\Project')->create();

        //When
        $project->recordActivity('test');

        //Then
        $this->assertCount(2, $project->activity);
        $this->assertEquals('test', $project->activity->last()->description);

    }
}
