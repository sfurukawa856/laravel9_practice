@component('mail::message')

# 昨日は{{ $count }}件のつぶやきが追加されました。

{{ $toUser->name }}さん
昨日は{{ $count }}件のつぶやきが追加されました。

@component('mail::button', ['url'=>route('tweet.index')])
つぶやきを見に行く
@endcomponent

@endcomponent