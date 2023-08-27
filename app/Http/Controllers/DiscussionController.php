<?php

namespace App\Http\Controllers;

use App\Http\Requests\Discussion\StoreRequest;
use App\Http\Requests\Discussion\UpdateRequest;
use App\Models\Category;
use App\Models\Discussion;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DiscussionController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index(Request $request)
	{
		$discussions = Discussion::with('user', 'category');

		if ($request->search) {
			$discussions->where('title', 'like', "%$request->search%")
				->orWhere('content', 'like', "%$request->search%");
		}

		return response()->view('pages.discussions.index', [
			'discussions' => $discussions->orderBy('created_at', 'desc')->paginate(5)->withQueryString(),
			'categories' => Category::all(),
			'search' => $request->search,
		]);
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
	public function show(string $slug)
	{
		$discussion = Discussion::with(['user', 'category'])->where('slug', $slug)->first();

		if (!$discussion) {
			return abort(404);
		}

		$likeImage = url('assets/images/like.png');
		$likedImage = url('assets/images/liked_alt.png');

		return response()->view('pages.discussions.show', [
			'discussion' => $discussion,
			'categories' => Category::all(),
			'likeImage' => $likeImage,
			'likedImage' => $likedImage,
		]);
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(string $slug)
	{
		$discussion = Discussion::with('category')->where('slug', $slug)->first();

		if (!$discussion) {
			return abort(404);
		}

		$isOwnedByUser = $discussion->user_id == auth()->id();

		if (!$isOwnedByUser) {
			return abort(404);
		}

		return response()->view('pages.discussions.form', [
			'discussion' => $discussion,
			'categories' => Category::all()
		]);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateRequest $request, string $slug)
	{
		$discussion = Discussion::with('category')->where('slug', $slug)->first(); // get the discussion by its slug

		if (!$discussion) {
			return abort(404); // return 404 | Not Found if there's no discussion found
		}

		$isOwnedByUser = $discussion->user_id == auth()->id();

		if (!$isOwnedByUser) {
			return abort(404); // return 404 | Not Found if the discussion isn't owned by correct user
		}

		$validated = $request->validated(); // validate the request
		$categoryId = Category::where('slug', $validated['category_slug'])->first()->id; // take categoryId from selected categorySlug

		$validated['category_id'] = $categoryId;
		$validated['user_id'] = auth()->id();

		$stripContent = strip_tags($validated['content']); // menghilangkan tag HTML didalam content
		$isContentLong = strlen($stripContent) > 120; // cek, apakah panjang karakter lebih dari 120 karakter
		$validated['content_preview'] = $isContentLong ? (substr($stripContent, 0, 120) . '...') : $stripContent;

		$update = $discussion->update($validated); // update into db using ORM

		if ($update) {
			session()->flash('notif.success', 'Discussion updated succesfully!'); // flash notify success message 
			return redirect()->route('discussions.show', $slug); // redirect if success
		}

		return abort(500); // abort if failed
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id)
	{
		//
	}
}
