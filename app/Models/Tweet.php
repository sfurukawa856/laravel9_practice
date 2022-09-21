<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model {
	use HasFactory;
	/**
	 * username method
	 * @param
	 * @return void
	 */
	public function user() {
		// Userモデルと関連付け
		return $this->belongsTo(User::class);
	}

	/**
	 * images method
	 * @param
	 * @return void
	 */
	public function images() {
		return $this->belongsToMany(Image::class, 'tweet_images')->using(TweetImage::class);
	}
}
