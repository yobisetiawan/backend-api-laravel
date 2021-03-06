@extends('mails.layout')

@section('content')

<p>Hi, {{$user_name}}.</p>
<p>There is a reset password request made from your account.
    If you don't know about this activity just ignore this email.
    Or if this request was made by you then click the link below to proceed.</p>


@component('mail::button', ['url' => $url, 'color' => 'success'])
Click Here
@endcomponent

@stop