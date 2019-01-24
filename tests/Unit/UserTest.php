<?php

namespace Tests\Unit;

use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase {
    use RefreshDatabase;

    /** @test */
    public function it_has_projects()
    {
        //Given
        $user = factory('App\User')->create();

        //Then
           $this->assertInstanceOf(Collection::class,$user->projects);
    }
}
