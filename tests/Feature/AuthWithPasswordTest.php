<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthWithPasswordTest extends TestCase
{
    use DatabaseMigrations;

    private string $tokenEndpoint = "/api/auth/login";
    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        //$this->artisan('db:seed', ['--class' => 'DatabaseSeeder']);
        $this->artisan('db:seed');
        $this->user = User::find(1);
    }

    /**
     * A basic feature test example.
     */
    /*
    public function test_that_token_gets_created_serverside(): void
    {
        \DB::table('personal_access_tokens')->where('tokenable_id', $this->user->id)->delete();

         $userInput = ['email' => $this->user->email, 'password' => 'teste123'];
        if (!$this->user || !Hash::check($userInput['password'], $this->user->password))
            dd('You did not supply the actual password of the user');

        $this->postJson($this->tokenEndpoint, $userInput)->assertStatus(200);
        $this->assertDatabaseHas('personal_access_tokens', ['tokenable_id' => $this->user->id]);
    }
    */
}
