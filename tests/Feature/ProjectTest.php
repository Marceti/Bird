<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTest extends TestCase
{
    use WithFaker, RefreshDatabase;


     /** @test */
         public function a_user_can_create_a_project()
         {
             $this->withoutExceptionHandling();

             //Given
            $projectData=[
              'title'=>$this->faker->sentence,
              'description'=>$this->faker->paragraph
            ];

            //When
            $response = $this->post('/projects',$projectData);

             //Then

             $response->assertRedirect('/projects');
           $this->assertDatabaseHas('projects',$projectData);
           $this->get('/projects',$projectData)->assertSee($projectData['title']);


         }
}
