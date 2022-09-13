<?php

namespace App\Console\Commands;

use App\Mail\DailyTweetCount;
use App\Models\User;
use App\Services\TweetService;
use Illuminate\Console\Command;
use Illuminate\Contracts\Mail\Mailer;

class SendDailyTweetCountMail extends Command {
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'mail:send-daily-tweet-count-mail';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = '前日のつぶやく数を集計してつぶやきを促すメールをおくります。';

	private TweetService $tweetService;
	private Mailer $mailer;

	/**
	 * __construct method
	 * @param
	 * @return void
	 */
	public function __construct(TweetService $tweetService, Mailer $mailer) {
		parent::__construct();
		$this->tweetService = $tweetService;
		$this->mailer = $mailer;
	}

	/**
	 * Execute the console command.
	 *
	 * @return int
	 */
	public function handle() {
		$tweetCount = (int)$this->tweetService->countYesterdayTweets();

		$users = User::get();

		foreach ($users as $user) {
			// TODO:ここまで来ていることを確認。なぜかsendできない
			$this->mailer->to($user->email)->send(new DailyTweetCount($user, $tweetCount));
		}

		return 0;
	}
}
