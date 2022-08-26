<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>つぶやきシロー</title>
</head>

<body>
	<h1>つぶやきシローアプリ</h1>
	@auth
	<div>
		<p>投稿フォーム</p>
		@if(session('feedback.success'))
		<p style="color:green">{{ 'feedback.success' }}</p>
		@endif
		<form action=" {{ route('tweet.create') }}" method="post">
			@csrf
			<label for="tweet-content">つぶやき</label>
			<span>140文字まで</span>
			<textarea name="tweet" id="tweet-content" type="text" placeholder="つぶやきを入力"></textarea>
			@error('tweet')
			<p style="color:red;">{{ $message }}</p>
			@enderror
			<button type="submit">投稿</button>
		</form>
	</div>
	@endauth
	<div>
		@foreach($tweets as $tweet)
		<details>
			<summary>{{ $tweet->content }} by {{ $tweet->user->name }}</summary>
			@if(\Illuminate\Support\Facades\Auth::id() === $tweet->user_id)
			<div>
				<a href="{{ route('tweet.update.index',['tweetId'=>$tweet->id]) }}">編集</a>
				<form action="{{ route('tweet.delete',['tweetId'=>$tweet->id]) }}" method="post">
					@method('delete')
					@csrf
					<button type="submit">削除</button>
				</form>
			</div>
			@else
			編集できません
			@endif
		</details>
		@endforeach
	</div>
</body>

</html>