<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

// Common Resource Routes:
// index - Show all posts
// show - Show single post
// create - Show form to create new post
// store - Store new post
// edit - Show form to edit post
// update - Update post
// destroy - Delete post  

//All Posts
Route::get('/', [PostController::class, 'index']);

//show create form 
//ova ruta mora biti iznad ovih sto primaju parametar da ne dojde do zabune
Route::get('/posts/create', [PostController::class, 'create'])->middleware('auth');

//store post data
Route::post('/posts', [PostController::class, 'store'])->middleware('auth');

//show edit post form
Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->middleware('auth');

//update post
Route::put('/posts/{post}', [PostController::class, 'update'])->middleware('auth');

//delete post
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->middleware('auth');

//manage posts
Route::get('/posts/manage', [PostController::class, 'manage'])->middleware('auth');

//Single post
Route::get('/posts/{post}', [PostController::class, 'show']);

//show register/create form
Route::get('/register', [UserController::class, 'create'])->middleware('guest'); //odi u route service provider i promini home url zbog pravilnog redirecta ako logirani user pokusa uci u register ili login page

//create new user
Route::post('/users', [UserController::class, 'store']);

//logout
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

//show login form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest'); //moras mu dati alijas zbog auth middlewera koji koristi redirect na rutu pod alijasom 'login'

//login user
Route::post('/users/authenticate', [UserController::class, 'authenticate']);

//All users
Route::get('/users', [UserController::class, 'index'])->middleware('auth');

//delete user
Route::delete('/users/{user}', [UserController::class, 'destroy'])->middleware('auth');

//show edit user form
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->middleware('auth');

//update user
Route::put('/users/{user}', [UserController::class, 'update'])->middleware('auth');
