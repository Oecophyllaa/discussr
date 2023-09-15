<?php

namespace App\Http\Controllers;

use App\Models\Answer;
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

	public function answerLike(string $answerId)
	{
		$answer = Answer::find($answerId);

		$answer->like();

		return response()->json([
			'status' => 'success',
			'data' => [
				'likeCount' => $answer->likeCount,
			]
		]);
	}

	public function answerUnlike(string $answerId)
	{
		$answer = Answer::find($answerId);

		$answer->unlike();

		return response()->json([
			'status' => 'success',
			'data' => [
				'likeCount' => $answer->likeCount,
			]
		]);
	}
}
