<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageProjectsTest extends TestCase {

    use WithFaker, RefreshDatabase;


    /** @test */
    public function a_project_must_have_a_title()
    {
        //Given
        $attributes = factory('App\Project')->make(['title' => '']);

        $this->actingAs(factory('App\User')->create());

        //when
        $response = $this->post('/projects', $attributes->toArray());

        //Then
        $response->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_project_must_have_a_description()
    {
        //Given
        $attributes = factory('App\Project')->make(['description' => '']);

        $this->actingAs(factory('App\User')->create());

        //when
        $response = $this->post('/projects', $attributes->toArray());

        //Then
        $response->assertSessionHasErrors('description');
    }

    /** @test */
    public function a_project_must_have_an_owner()
    {
        //Given
        $attributes = factory('App\Project')->raw();

        //when
        $response = $this->post('/projects', $attributes);

        //Then
        $response->assertRedirect('login');
    }

    /** @test */
    public function only_authenticated_user_can_create_a_project()
    {
        $this->withoutExceptionHandling();

        //Given
        $this->actingAs(factory('App\User')->create());

            //Given: route exists (form exists)
            $this->get('/projects/create')->assertStatus(200);

        $projectData = [
            'title'       => $this->faker->sentence,
            'description' => $this->faker->paragraph,
        ];

        //When
        $response = $this->post('/projects', $projectData);

        //Then
        $response->assertRedirect('/projects');
        $this->assertDatabaseHas('projects', $projectData);
        $this->get('/projects', $projectData)->assertSee($projectData['title']);
    }



    /** @test */
    public function a_user_can_view_their_project()
    {
        $this->withoutExceptionHandling();

        //Given
        $user=factory('App\User')->create();
        $this->actingAs($user);

        $project = factory('App\Project')->create(['owner_id'=>auth()->id()]);

        //When
        $response = $this->get($project->path());

        //Then
        $response->assertSee($project->title);
        $response->assertSee($project->description);
    }

    /** @test */
    public function authenticated_user_cannot_view_others_projects()
    {
        $this->withoutExceptionHandling();

        //Given
        $user=factory('App\User')->create();
        $this->actingAs($user);

        $project = factory('App\Project')->create();
        //When
        $response = $this->get('/projects');

        //Then
        $response->assertDontSee($project->title);
    }

    /** @test */
    public function authenticated_user_cannot_view_others_single_project()
    {
        //Given
        $user=factory('App\User')->create();
        $this->actingAs($user);

        $project = factory('App\Project')->create();
        //When
        $response = $this->get($project->path());

        //Then
        $response->assertStatus(403);
    }

    
    /** @test */
    public function a_guest_cannot_create_a_project()
    {
        //Given
        $attributes = factory('App\Project')->raw();

        //When
        $response = $this->post('/projects',$attributes);

        //Then
        $response->assertRedirect('/login');
    }

    /** @test */
    public function a_guest_cannot_see_create_a_project_form()
    {
        //Given
        $attributes = factory('App\Project')->raw();

        //When
        $response =  $this->get('/projects/create');

        //Then
        $response->assertRedirect('/login');
    }

    /** @test */
    public function a_guest_cannot_view_a_project()
    {
        //Given
        $project = factory('App\Project')->create();

        //When
        $response = $this->get('/projects');

        //Then
        $response->assertRedirect('/login');
    }

    /** @test */
    public function a_guest_cannot_view_a_single_project()
    {
        //Given
        $project = factory('App\Project')->create();

        //When
        $response = $this->get($project->path());

        //Then
        $response->assertRedirect('/login');
    }
    

    
}