<?php

namespace App\Services;

use App\Models\Tweet;
use phpDocumentor\Reflection\Types\Boolean;

class TweetService {
	/**
	 * getTweets method
	 * @param
	 * @return void
	 */
	public function getTweets() {
		return Tweet::orderBy('created_at', 'DESC')->get();
	}
	/**
	 * checkOwnTweet method 自分のtweetかどうかを確認するメソッド
	 * @param
	 * @return void
	 */
	public function checkOwnTweet(int $userId, int $tweetId): bool {
		$tweet = Tweet::where('id', $tweetId)->first();
		if (!$tweet) {
			return false;
		}
		return $tweet->userId === $userId;
	}
}
