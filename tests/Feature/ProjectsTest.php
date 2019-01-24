<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectsTest extends TestCase {

    use WithFaker, RefreshDatabase;

    /** @test */
    public function only_authenticating_user_can_create_a_project()
    {
        $this->withoutExceptionHandling();

        //Given
        $this->actingAs(factory('App\User')->create());

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
    public function a_user_can_view_a_project()
    {
        $this->withoutExceptionHandling();

        //Given
        $project = factory('App\Project')->create();

        //When
        $response = $this->get($project->path());

        //Then
        $response->assertSee($project->title);
        $response->assertSee($project->description);
    }
}
