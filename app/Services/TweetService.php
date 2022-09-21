<?php

namespace App\Services;

use App\Models\Tweet;
use Carbon\Carbon;
use App\Models\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class TweetService {
	public function getTweets() {
		return Tweet::with('images')->orderBy('created_at', 'DESC')->get();
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

	/**
	 * saveTweet method
	 * @param
	 * @return void
	 */
	public function saveTweet(int $userId, string $content, array $images) {
		DB::transaction(function () use ($userId, $content, $images) {
			$tweet = new Tweet;
			$tweet->user_id = $userId;
			$tweet->content = $content;
			$tweet->save();
			foreach ($images as $image) {
				Storage::putFile('public/images', $image);
				$imageModel = new Image();
				$imageModel->name = $image->hashName();
				$imageModel->save();
				$tweet->images()->attach($imageModel->id);
			}
		});
	}

	/**
	 * deleteTweet method
	 * @param
	 * @return void
	 */
	public function deleteTweet(int $tweetId) {
		DB::transaction(function () use ($tweetId) {
			$tweet = Tweet::where('id', $tweetId)->firstOrFail();
			$tweet->images()->each(function ($image) use ($tweet) {
				if (self::isFullPath($image->name)) {
					$filePath = $image->name;
				} else {
					$filePath = 'public/images/' . $image->name;
				}
				if (Storage::exists($filePath)) {
					Storage::delete($filePath);
				}
				$tweet->images()->detach($image->id);
				$image->delete();
			});

			$tweet->delete();
		});
	}

	/**
	 * isFullPath method
	 * @param
	 * @return void
	 */
	public static function isFullPath($path) {
		if (strpos($path, 'https') !== false) {
			return true;
		} else {
			return false;
		}
	}
}
