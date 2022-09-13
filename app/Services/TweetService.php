<?php

namespace App\Services;

use App\Models\Tweet;
use Carbon\Carbon;

class TweetService {
	public function getTweets() {
		return Tweet::orderBy('created_at', 'DESC')->get();
	}

	/**
	 * checkOwnTweet() method
	 * @param
	 * @return void
	 */
	public function checkOwnTweet(int $userId, int $tweetId) {
		$tweet = Tweet::where('id', $tweetId)->first();
		if (!$tweet) return false;

		return $tweet->user_id === $userId;
	}

	/**
	 * countYesterdayTweets method
	 * @param
	 * @return void
	 */
	public function countYesterdayTweets(): int {
		return Tweet::whereDate('created_at', '>=', Carbon::yesterday()->toDateTimeString())->count();
	}
}
