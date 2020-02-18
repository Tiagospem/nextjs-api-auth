<?php

namespace Tests\Feature;

use App\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Faker\Factory;

class BookTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /** @test */
    public function authenticated_user_should_create_a_book()
    {
        $user = $this->postJson('/api/v1/register', [
            'email' => 'tvpeter@email.com',
            'name' => 'Tyonum Petr',
            'password' => 'password2019',
        ]);
        $token = json_decode($user->getContent()); 
        $header = ['Authorization' => 'Bearer'.$token->access_token];
        
        $payload = [
            'title' => 'This is my Book Title',
            'description' => 'This is the description of cthe fictional book',
        ];
        // create a new book 
        $response = $this->post('/api/v1/books', $payload, $header);

        $response->assertSuccessful();
        $response->assertSeeText('This is my Book Title');
        $response->assertStatus(201);

    }
    /** @test */
    public function return_error_if_all_inputs_are_not_supplied()
    {
        $user = $this->postJson('/api/v1/register', [
            'email' => 'tvpeter@tvp.com',
            'name' => 'Tyonum Proff',
            'password' => 'password2019',
        ]);
        $token = json_decode($user->getContent()); 
        $header = ['Authorization' => 'Bearer'.$token->access_token];
        
        $payload = [
            'title' => 'This is my Book Title',
        ];
        // create a new book 
        $response = $this->postJson('/api/v1/books', $payload, $header);
        $response->assertJsonStructure([
            'message', 
            'errors',
        ]);
        $response->assertStatus(422);
    }
     /** @test */
     public function unauthenticated_user_cannot_create_a_book()
     {
         $payload = [
             'title' => 'This is my Book for 2019',
             'description' => 'This is the description of the book',
         ];
         // create a new book 
         $response = $this->postJson('/api/v1/books', $payload);
 
         $response->assertUnauthorized();
     }

     /**
      * @test
      */

      public function return_array_of_books()
      {
          $response = $this->get('/api/v1/books');
          $response->assertStatus(200);
          $response->assertJsonStructure(['data']);
      }

      /**
       * @test
       */
      public function return_a_single_book(){

        factory(Book::class)->create();
        
        $bookId = Book::all()->first()->id;

        $response = $this->get('/api/v1/books/'.$bookId);
        $response->assertJsonStructure([
            'data',
        ]);
        $response->assertStatus(200);

      }
       /**
       * @test
       */
      public function should_update_a_book(){

        $user = $this->postJson('/api/v1/register', [
            'email' => 'tvpeter@email.com',
            'name' => 'Tyonum Petr',
            'password' => 'password2019',
        ]);
        $token = json_decode($user->getContent()); 
        $header = ['Authorization' => 'Bearer'.$token->access_token];
        
        $payload = [
            'title' => 'This is my Book Title',
            'description' => 'This is the description of cthe fictional book',
        ];
        // create a new book 
       $this->post('/api/v1/books', $payload, $header);

        $bookId = Book::all()->last()->id;

        $response = $this->patchJson('/api/v1/books/'.$bookId, 
            ['title' => 'my changed title'], $header);
    
        $response->assertSuccessful();
        $response->assertSeeText('my changed title');

      }
       /**
       * @test
       */
      public function user_deletes_a_book(){

        $user = $this->postJson('/api/v1/register', [
            'email' => 'tvpeter@email.com',
            'name' => 'Tyonum Petr',
            'password' => 'password2019',
        ]);
        $token = json_decode($user->getContent()); 
        $header = ['Authorization' => 'Bearer'.$token->access_token];
        
        $payload = [
            'title' => 'This is my Book Title',
            'description' => 'This is the description of cthe fictional book',
        ];
        // create a new book 
       $this->post('/api/v1/books', $payload, $header);

        $bookId = Book::all()->last()->id;

        $response = $this->deleteJson('/api/v1/books/'.$bookId, [], $header);
    
        $response->assertStatus(204);

      }
}
