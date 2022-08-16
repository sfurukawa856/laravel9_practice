<?php

namespace App\Http\Controllers\Tweet;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tweet\CreateRequest;
// Tweetモデルをインポート
use App\Models\Tweet;

class CreateController extends Controller {
	/**
	 * Handle the incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function __invoke(CreateRequest $request) {
		$tweet = new Tweet;
		// CreateRequestで取得してきたuserIdをここで取得
		$tweet->user_id = $request->userId();
		// $tweetのcontentにツイート内容を代入
		$tweet->content = $request->tweet();
		// 保存
		$tweet->save();

		return redirect()->route('tweet.index');
	}
}
