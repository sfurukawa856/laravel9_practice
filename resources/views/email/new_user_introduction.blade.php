@component('mail::message')

# 新しいユーザーが追加されました
{{ $toUser->name }}さん
@component('mail::panel')
新しく{{ $newUser->name }}さんが追加されました。
@endcomponent

@component('mail::button', ['url'=>route('tweet.index')])
つぶやきを見に行く
@endcomponent

@endcomponent