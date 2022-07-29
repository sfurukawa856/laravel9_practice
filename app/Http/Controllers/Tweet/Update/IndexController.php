<?php

namespace App\Http\Controllers\Tweet\Update;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tweet;
use Illuminate\Validation\Rules\NotIn;
use Mockery\Matcher\Not;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class IndexController extends Controller {
	/**
	 * Handle the incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function __invoke(Request $request) {
		// こうやってURLのIDを取得するのか
		$tweetId = (int)$request->route('tweetId');
		// 下記の書き方で見つからなかった場合、404エラーになる（throwするのと一緒）
		$tweet = Tweet::where('id', $tweetId)->firstOrFail();
		return view('tweet.update')->with('tweet', $tweet);
	}
}
