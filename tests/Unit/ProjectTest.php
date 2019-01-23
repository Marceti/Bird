<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
        public function a_project_has_a_path()
        {
        //Given
          $project=factory('App\Project')->create();

          //Then
        $this->assertEquals('/projects/'.$project->id,$project->path());
        }

}
