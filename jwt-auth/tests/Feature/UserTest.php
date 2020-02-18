<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use App\User;
use Illuminate\Support\Str;

class UserTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_should_register_a_user()
    {

        $response = $this->postJson('/api/v1/register', [
            'email' => 'tvpeter@example.com',
            'name' => 'tyonum peter vihiga',
            'password' => bcrypt('passwordexample2019'),
        ]);

        $response->assertJsonStructure([
            'access_token',
            'token_type',
            'expires_in',
        ]);
    }

    /**@test */
    public function return_error_if_registration_data_is_not_complete()
    {
        $response = $this->postJson('/api/v1/register', [
            'email' => $this->faker->safeEmail,
            'password' => bcrypt('passwordexample2019'),
        ]);

        $response->assertJsonStructure([
            'errors'
        ]);

    }
    /** @test */
    public function it_should_login_user()
    {
       $user = factory(User::class)->create([
        'name' => 'tyonum peter',
        'email' => 'tvpeter@gmail.com',
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 
       ]);

       $payload = ['email' => 'tvpeter@gmail.com', 'password'=> 'password'];

        $response = $this->postJson('/api/v1/login', $payload);

        $response->assertJsonStructure([
            'access_token',
            'token_type',
            'expires_in'
        ]);
    }

    /** @test */
    public function it_will_not_log_an_invalid_user_in()
    {
        $response = $this->postJson('api/v1/login', [
            'email'    => 'tvpeter@email.com',
            'password' => 'invalidpasswordhere'
        ]);
        $response->assertJsonStructure([
            'error'
        ]);
    }

    /** @test */
    public function it_should_log_a_user_out()
    {
        $user = $this->postJson('/api/v1/register', [
            'email' => 'tvpeter@email.com',
            'name' => 'Tyonum Petr',
            'password' => 'password2019',
        ]);
        $token = json_decode($user->getContent()); 
        $header = ['Authorization' => 'Bearer'.$token->access_token];
        
        $response = $this->json('post', 'api/v1/logout', [], $header);
        $response->assertExactJson(['message' => 'successfully logged out']);
       
    }

    public function it_should_reject_unauthenticated_user_logout()
    {
        $token = Str::random(60);
        $header = ['Authorization' => 'Bearer'.$token];
        
        $response = $this->json('post', 'api/v1/logout', [], $header);
        $response->assertNoContent(204);
    }
}
