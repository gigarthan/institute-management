<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminCanAddInstituteTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * POST data
     * @var array
     */
    private $instituteData = [
        'name' => 'Institute1',
        'address' => 'Colombo',
        'phone' => '9476051245'
    ];

    /**
     * An Admin of the system should be able to
     * create a new institute
     * @return void
     */
    public function test_admin_can_add_an_institute()
    {
        $this->withoutExceptionHandling();
        $admin = factory(User::class)->states('admin')->create();

        $response = $this
                        ->actingAs($admin)
                        ->post('/institutes', $this->instituteData);

        $response->assertStatus(201);
        $response->assertJson(['success' => true]);

    }

    public function test_a_non_admin_cannot_create_an_institute()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();

        $response = $this
            ->actingAs($user)
            ->post('/institutes', $this->instituteData);

        $response->assertStatus(401);
    }

    public function test_cannot_create_an_institute_with_empty_data() {
        $admin = factory(User::class)->states('admin')->create();
        $instituteData = [];

        $response = $this
            ->actingAs($admin)
            ->post('/institutes', $instituteData);

        // Laravel respond with 302 redirect when invalid data is passed
        $response->assertStatus(302);
    }


}
