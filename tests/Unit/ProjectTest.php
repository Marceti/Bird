<?php

namespace Tests\Unit;

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
        $project = factory('App\Project')->create(['owner_id'=>$user->id]);

        //Then
        $this->assertInstanceOf(Model::class,$project->owner);
        $this->assertEquals($project->owner->id,$user->id);
    }


}
