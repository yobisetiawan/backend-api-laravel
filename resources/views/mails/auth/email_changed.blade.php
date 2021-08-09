@extends('mails.layout')

@section('content')

<p>Hi, {{$user_name}}.</p>
<p>Your account email has changed,
    We’re confirming that you changed your account email to {{$new_email}}.
</p>
<p> If you didn't make this change, <a href="{{$let_us_link}}">let us know immediately</a></p>

@stop