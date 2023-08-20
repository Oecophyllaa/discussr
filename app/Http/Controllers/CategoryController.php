<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Discussion;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
	public function show($categorySlug)
	{
		$category = Category::where('slug', $categorySlug)->first(); // get category by it slug

		if (!$category) { // check, the category if found
			return abort(404); // return abort 404 / Not Found
		}

		$discussions = Discussion::with(['user', 'category'])
			->where('category_id', $category->id)
			->orderBy('created_at', 'desc')
			->paginate(5)
			->withQueryString();

		return response()->view('pages.discussions.index', [
			'discussions' => $discussions,
			'categories' => Category::all(),
			'withCategory' => $category,
		]);
	}
}
