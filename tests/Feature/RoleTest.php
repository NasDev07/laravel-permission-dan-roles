<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoleTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCanShowRolePage()
    {
        $user = User::role('it')->get()->random();

        $this->actingAs(($user));
        $this->get('/roles')
            ->assertOk();
    }

    public function testCannotShowRolePage()
    {
        $user = User::role('staff')->get()->random();
        $this->actingAs($user)
            ->get('roles')
            ->assertStatus(403);
    }

    public function testCannotShowROleNotLogin()
    {
        $this->get('roles')
            ->assertRedirect('login')
            ->assertStatus(302);
    }

    public function testCanCreateRole()
    {
        $user = User::role('it')->get()->random();
        $this->actingAs($user)
            ->get('roles/create')
            ->assertOk();
    }

    public function testCannotCreateRole()
    {
        $user = User::role('staff')->get()->random();
        $this->actingAs($user)
            ->get('roles/create')
            ->assertStatus(403)
            ->assertSeeText('unauthorized');
    }

    public function testCannotCreateRoleNotLogin()
    {
        $this->get('roles/create')
            ->assertRedirect('login')
            ->assertStatus(302);
    }
}
