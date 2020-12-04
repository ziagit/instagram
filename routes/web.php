<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {

    if(auth()->check()){
        return redirect("posts");
    }
    
    return view('auth.login');
});

Route::post("/resend-email/{email}/{name}/{id}","UsersController@sendEmail");
Route::post("/register-user","UsersController@registerUser")->name("registeruser");

//Route socialate
Route::get('authorized/google', 'LoginWithSocialiteController@redirectToGoogle');
Route::get('authorized/google/callback', 'LoginWithSocialiteController@handleGoogleCallback');
Route::get('/authorized/facebook', 'LoginWithSocialiteController@redirectTofacebook');
Route::get('/authorized/facebook/callback', 'LoginWithSocialiteController@handleFacebookCallback');

Auth::routes();
Route::get("/verify-user-email/{email}/{id}","UsersController@registerVerifyUser");
Route::middleware(['auth'])->group(function () {
    //Post routes
    Route::get('/posts', 'PostsController@index')->name('posts');
    Route::get('/posts/following', 'PostsController@following')->name('posts.following');
    Route::get('/posts/create', 'PostsController@create')->name('posts.create');
    Route::get('/posts/liked', 'PostsController@liked')->name('posts.liked');
    Route::get('/posts/{post}', 'PostsController@show')->name('posts.show');
    Route::get('/posts/{post}/edit', 'PostsController@edit')->name('posts.edit');
    Route::get("/posts/{id}/details","PostsController@postDetails")->name("posts.details");
    Route::put('/posts', 'PostsController@store')->name('posts.store');
    Route::post('/posts/{post}', 'PostsController@like')->name('posts.like');
    Route::patch('/posts/{post}', 'PostsController@update')->name('posts.update');
    Route::delete('/posts/{post}', 'PostsController@destroy')->name('posts.destroy');
    Route::get("/multipleimages",function(){
        return view("posts.multipleimage");
    });
    Route::post("/multipleimages","PostsController@storeMultipleimage")->name("multipleimages.store");

    //Users
    Route::get('/account/settings', 'UsersController@settings')->name('account');
    Route::get('/user/{user}', 'UsersController@show')->name('account.show');
    Route::get("/get-users/{name}","UsersController@getUsers");
    Route::patch('/account/settings', 'UsersController@update')->name('account.update');
    Route::post('/user/{user}', 'UsersController@follow')->name('account.follow');
  
    //When logged in: Redirect /account to current users profile, /user/1 etc.
    Route::get('/account', function () {
        return redirect()->route('account.show', ['id' => Auth::id()]);
    });

    //Comments route
    Route::post("comment","CommentController@store")->name('comment');
});
