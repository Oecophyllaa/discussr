<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
	public function index()
	{
		return view('pages.auth.register');
	}

	public function register(RegisterRequest $request)
	{
		$validated = $request->validated();
		$validated['password'] = bcrypt($validated['password']);
		$validated['picture'] = config('app.avatar_generator_url') . $validated['username'];

		$create = User::create($validated);

		if ($create) {
			Auth::login($create);
			return redirect()->route('discussions.index');
		}

		return abort(500);
	}
}
