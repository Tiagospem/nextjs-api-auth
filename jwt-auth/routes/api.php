<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => 'v1'], function ()
{
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::get('users', 'AuthController@index');

    Route::middleware('auth:api')->group(function () {

        Route::get('ping', 'PingController@index');

        Route::post('logout', 'AuthController@logout');

        //rotas de categoria
        Route::get('/categories', 'CategoryController@index');
        Route::post('/categories', 'CategoryController@store');
        Route::put('/categories/{id}', 'CategoryController@update');
        Route::get('/categories/{id}', 'CategoryController@show');
        Route::delete('/categories/{id}', 'CategoryController@destroy');

        //rotas de subcategoria
        Route::get('/subcategories', 'SubCategoryController@index');
        Route::get('/subcategories/{id}', 'SubCategoryController@show');
        Route::post('/subcategories', 'SubCategoryController@store');
        Route::put('/subcategories/{id}', 'SubCategoryController@update');
        Route::delete('/subcategories/{id}', 'SubCategoryController@destroy');

        //rotas de post
        Route::get('/posts', 'PostController@index');
        Route::get('/posts/{id}', 'PostController@show');
        Route::post('/posts', 'PostController@store');
        Route::put('/posts/{id}', 'PostController@update');
        Route::delete('/posts/{id}', 'PostController@destroy');

        //rotas de subpost
        Route::post('/subposts/{post_id}', 'SubPostController@store');
        Route::put('/subposts/{id}', 'SubPostController@update');
        Route::delete('/subposts/{id}', 'SubPostController@destroy');

        Route::get('/galeries', 'GaleryController@index');
        Route::post('/galeries/{id}/local/{sub_or_post}', 'GaleryController@store');
        Route::delete('/galeries/{id}', 'GaleryController@destroy');

        //rotas de file
        Route::get('/files', 'FileController@index');
        Route::post('/files/{id}/local/{sub_or_post}', 'FileController@store');
        Route::delete('/files/{id}', 'FileController@destroy');

        //rotas de youtube
        Route::get('/movies', 'YoutubeUrlController@index');
        Route::post('/movies/{id}/local/{sub_or_post}', 'YoutubeUrlController@store');
        Route::put('/movies/{id}', 'YoutubeUrlController@update');
        Route::delete('/movies/{id}', 'YoutubeUrlController@destroy');

        //rotas de comments
        Route::get('/replies/{post_id}', 'CommentController@index');
        Route::post('/replies/{post_id}', 'CommentController@store');
        Route::put('/replies/{id}', 'CommentController@update');
        Route::delete('/replies/{id}', 'CommentController@destroy');
    });
});

