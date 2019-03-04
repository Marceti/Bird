<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_projects()
    {
        //Given
        $user = factory('App\User')->create();

        //Then
        $this->assertInstanceOf(Collection::class, $user->projects);
    }
}
