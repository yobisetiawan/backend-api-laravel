@extends('mails.layout')

@section('content')

<p>Hello, {{$user_name}}.</p>
<p>You are one step away from finishing your registration process.
    Click this link below to complete the registration.</p>


@component('mail::button', ['url' => $url, 'color' => 'success'])
Click Here
@endcomponent

@stop