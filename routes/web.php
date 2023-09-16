<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\DiscussionController;
use App\Http\Controllers\My\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route-Group-Middleware
Route::middleware('auth')->group(function () {
	Route::namespace('App\Http\Controllers\My')->group(function () {
		Route::resource('users', UserController::class)->only(['edit', 'update']);
	});

	Route::namespace('App\Http\Controllers')->group(function () {
		Route::resource('discussions', DiscussionController::class)
			->only(['create', 'store', 'edit', 'update', 'destroy']);
		Route::post('/discussions/{discussion}/like', 'LikeController@discussionLike')->name('discussions.like');
		Route::post('/discussions/{discussion}/unlike', 'LikeController@discussionUnlike')->name('discussions.unlike');

		Route::post('/discussions/{discussion}/answer', 'AnswerController@store')->name('discussions.answer.store');

		Route::resource('answers', AnswerController::class)->only(['edit', 'update', 'destroy']);
		Route::post('/answer/{answer}/like', 'LikeController@answerLike')->name('answer.like');
		Route::post('/answer/{answer}/unlike', 'LikeController@answerUnlike')->name('answer.unlike');
	});
});

// Route-Group-Guests
Route::namespace('App\Http\Controllers')->group(function () {
	Route::get('/', 'HomeController@index')->name('home');

	Route::resource('discussions', DiscussionController::class)->only(['index', 'show']);

	Route::get('/discussions/categories/{category}', 'CategoryController@show')->name('discussions.categories.show');
});

Route::namespace('App\Http\Controllers\Auth')->group(function () {
	Route::get('/login', 'LoginController@index')->name('login');
	Route::post('/login', 'LoginController@login')->name('login.auth');
	Route::post('/logout', 'LoginController@logout')->name('logout');

	Route::get('/register', 'RegisterController@index')->name('register');
	Route::post('/register', 'RegisterController@register')->name('register.regist');
});

Route::namespace('App\Http\Controllers\My')->group(function () {
	Route::resource('users', UserController::class)->only(['show']);
});
