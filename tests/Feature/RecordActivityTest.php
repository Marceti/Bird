<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RecordActivityTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
        public function creating_a_project()
        {
        //Given
          $project=factory('App\Project')->create();

          //Then
          $this->assertCount(1,$project->activity);
            $this->assertEquals('created_project',$project->activity->last()->description);
        }

    /** @test */
    public function updating_a_project()
    {
        //Given
        $project=factory('App\Project')->create();

        //When
        $project->update(['description'=>'updated']);

        //Then
        $this->assertCount(2,$project->activity);
        $this->assertEquals('updated_project',$project->activity->last()->description);
    }
}
