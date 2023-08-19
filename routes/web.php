<?php

use App\Http\Controllers\DiscussionController;
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

Route::middleware('auth')->group(function () {
	Route::namespace('App\Http\Controllers')->group(function () {
		Route::resource('discussions', DiscussionController::class)
			->only(['create', 'store', 'edit', 'update', 'destroy']);
	});
});

Route::namespace('App\Http\Controllers')->group(function () {
	Route::resource('discussions', DiscussionController::class)->only(['index', 'show']);
});

Route::get('/', function () {
	return view('home');
})->name('home');

Route::namespace('App\Http\Controllers\Auth')->group(function () {
	Route::get('/login', 'LoginController@index')->name('login');
	Route::post('/login', 'LoginController@login')->name('login.auth');
	Route::post('/logout', 'LoginController@logout')->name('logout');

	Route::get('/register', 'RegisterController@index')->name('register');
	Route::post('/register', 'RegisterController@register')->name('register.regist');
});

Route::get('/discussions/xyz', function () {
	return view('pages.discussions.show');
})->name('discussions.show');

Route::get('/replies/1', function () {
	return view('pages.replies.form');
})->name('replies.edit');

Route::get('/users/oecophylla', function () {
	return view('pages.users.show');
})->name('users.show');

Route::get('/users/oecophylla/edit', function () {
	return view('pages.users.form');
})->name('users.edit');
