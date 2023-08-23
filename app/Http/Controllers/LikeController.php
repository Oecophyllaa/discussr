<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use Illuminate\Http\Request;

class LikeController extends Controller
{
	public function discussionLike(string $dicussionSlug)
	{
		$discussion = Discussion::where('slug', $dicussionSlug)->first();

		$discussion->like();

		return response()->json([
			'status' => 'success',
			'data' => [
				'likeCount' => $discussion->likeCount,
			],
		]);
	}

	public function discussionUnlike(string $dicussionSlug)
	{
		$discussion = Discussion::where('slug', $dicussionSlug)->first();

		$discussion->unlike();

		return response()->json([
			'status' => 'success',
			'data' => [
				'likeCount' => $discussion->likeCount,
			],
		]);
	}
}
