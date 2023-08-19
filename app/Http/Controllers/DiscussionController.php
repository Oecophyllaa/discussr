<?php

namespace App\Http\Controllers;

use App\Http\Requests\Discussion\StoreRequest;
use App\Models\Category;
use App\Models\Discussion;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DiscussionController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		return response()->view('pages.discussions.form', [
			'categories' => Category::all(),
		]);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreRequest $request)
	{
		$validated = $request->validated(); // validasi request
		$categoryId = Category::where('slug', $validated['category_slug'])->first()->id; // ambil categoryId dari categorySlug yg dipilih

		$validated['category_id'] = $categoryId;
		$validated['user_id'] = auth()->id();
		$validated['slug'] = Str::slug($validated['title']) . '-' . Str::lower(Str::random(5)); // slugify title discussions

		$stripContent = strip_tags($validated['content']); // menghilangkan tag HTML didalam content
		$isContentLong = strlen($stripContent) > 120; // cek, apakah panjang karakter lebih dari 120 karakter
		$validated['content_preview'] = $isContentLong ? (substr($stripContent, 0, 120) . '...') : $stripContent;

		$create = Discussion::create($validated); // store into db using ORM

		if ($create) {
			session()->flash('notif.success', 'Discussion created succesfully!'); // flash notify success message 
			return redirect()->route('discussions.index'); // redirect if success
		}

		return abort(500); // abort if failed
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
