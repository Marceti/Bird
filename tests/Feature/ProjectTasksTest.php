<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;
     /** @test */
         public function a_project_can_have_tasks()
         {
             $this->withoutExceptionHandling();
         //Given
           $this->signIn();
           $project=factory('App\Project')->create(['owner_id'=>auth()->id()]);

           //When
          $this->post($project->path().'/tasks',['body'=>'Lorem ipsum !!!']);
           
           //Then

             $response = $this->get($project->path());
             $response->assertSee('Lorem ipsum !!!');
         }
}
