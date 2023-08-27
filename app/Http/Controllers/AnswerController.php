<?php

namespace App\Http\Controllers;

use App\Http\Requests\Answer\StoreRequest;
use App\Models\Answer;
use App\Models\Discussion;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreRequest $request, $slug)
	{
		$validated = $request->validated();

		$validated['user_id'] = auth()->id();
		$validated['discussion_id'] = Discussion::where('slug', $slug)->first()->id;

		$create = Answer::create($validated);

		if ($create) {
			session()->flash('notif.success', 'Your input has been published!');
			return redirect()->route('discussions.show', $slug);
		}

		return abort(500);
	}

	/**
	 * Display the specified resource.
	 */
	public function show(string $id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(string $id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, string $id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id)
	{
		//
	}
}
