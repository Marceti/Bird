<?php

namespace Tests\Feature;

use App\Project;
use Tests\TestCase;
use Tests\setup\ProjectSetup;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function guests_cannot_manage_projects()
    {
        //Given
        $project = factory(Project::class)->create();

        //When //Then

        $this->get('/projects')->assertRedirect('login');
        /* INDEX */
        $this->get('/projects/create')->assertRedirect('login');
        /* CREATE FORM */
        $this->get('/projects/edit')->assertRedirect('login');
        /* EDIT FORM */
        $this->get($project->path())->assertRedirect('login');
        /* SHOW */
        $this->post('/projects')->assertRedirect('login');
        /* CREATE */
    }

    /** --------------VALIDATION-------------- */

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

    /** ---------------CREATE----------------- */

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
            'notes'       => 'Some general notes 2',
        ];

        //When
        $response = $this->post('/projects', $projectData);

        //Then
        $response->assertRedirect('/projects');
        $this->assertDatabaseHas('projects', $projectData);
        $project = Project::where($projectData)->first();

        /* Verificam daca se vede in index */
        $this->get('/projects', $projectData)->assertSee($projectData['title']);

        /* Verificam daca se vede in pagina proiectului */
        $this->get($project->path())
            ->assertSee($projectData['title'])
            ->assertSee($projectData['description'])
            ->assertSee($projectData['notes']);
    }

    /** @test */
    public function a_guest_cannot_create_a_project()
    {
        //Given
        $attributes = factory('App\Project')->raw();

        //When
        $response = $this->post('/projects', $attributes);

        //Then
        $response->assertRedirect('/login');
    }

    /** @test */
    public function a_guest_cannot_see_create_a_project_form()
    {
        //Given
        $attributes = factory('App\Project')->raw();

        //When
        $response = $this->get('/projects/create');

        //Then
        $response->assertRedirect('/login');
    }

    /** ------------------------------SHOW----------------------------- */

    /** @test */
    public function a_user_can_view_their_project()
    {
        $this->withoutExceptionHandling();

        //Given
        $user = factory('App\User')->create();
        $this->signIn();

        $project = factory('App\Project')->create(['owner_id' => auth()->id()]);

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
        $user = factory('App\User')->create();
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
        $user = factory('App\User')->create();
        $this->actingAs($user);

        $project = factory('App\Project')->create();
        //When
        $response = $this->get($project->path());

        //Then
        $response->assertStatus(403);
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

    /** ------------------------UPDATE-------------------------- */

    /** @test */
    public function authenticated_user_can_update_a_project()
    {
        $this->withoutExceptionHandling();
        //Given
        $this->signIn();
        $project = factory('App\Project')->create(['owner_id' => auth()->id()]);

        //When
        $response = $this->patch($project->path(), [
            'title'       => 'title33',
            'description' => 'desc5',
            'notes'       => 'some notes 123',
        ]);

        //Then
        $response->assertRedirect($project->path());

        $this->assertDatabaseHas('projects', [
            'title'       => 'title33',
            'description' => 'desc5',
            'notes'       => 'some notes 123',
        ]);
    }

    /** @test */
    public function authenticated_user_cannot_update_others_projects()
    {

        //Given
        $this->signIn();
        $project = factory('App\Project')->create();

        //When
        $response = $this->patch($project->path(), [
            'title'       => 'title33',
            'description' => 'desc5',
            'notes'       => 'some notes 123',
        ]);

        //Then
        $response->assertStatus(403);
    }

    /** -----------------------------EDIT----------------------------- */

    /** @test */
    public function authenticated_user_can_load_editForm_page_for_owned_project()
    {
        $this->withoutExceptionHandling();
        $project = app(ProjectSetup::class)->ownedBy($this->signIn())->create();

        //When
        $repsonse = $this->get($project->path().'/edit');

        //Then

        $repsonse->assertStatus(200);
        $repsonse->assertOk();
    }

    /** @test */
    public function authenticated_user_cannot_load_editForm_page_for_others_project()
    {
        $this->withoutExceptionHandling();
        $this->signIn();
        $project = factory('App\Project')->create();

        //When
        $this->expectException('Illuminate\Auth\Access\AuthorizationException');
        $repsonse = $this->get($project->path().'/edit');
    }

    /** @test */
    public function owner_can_delete_a_project()
    {
        $this->withoutExceptionHandling();
        //Given
        $user = factory('App\User')->create();
        $this->actingAs($user);
        $project = factory('App\Project')->create(['owner_id' => $user->id]);

        $this->assertDatabaseHas('projects', $project->toArray());
        //When
        $response = $this->delete($project->path());

        //Then
        $this->assertDatabaseMissing('projects', $project->toArray());
        $response->assertRedirect(route('projects'));
    }

    /** @test */
    public function authenticated_user_cannot_delete_others_project()
    {
        // $this->withoutExceptionHandling();

        //Given
        $project = factory('App\Project')->create();

        //When
        $this->assertDatabaseHas('projects', $project->toArray());
        $response = $this->delete($project->path());

        //Then
        $response->assertRedirect(route('login'));

        //When
        $this->actingAs(factory('App\User')->create());
        $response = $this->delete($project->path());

        //Then
        //  $this->expectException('Illuminate\Auth\Access\AuthorizationException');
        $response->assertStatus(403);
    }
}
