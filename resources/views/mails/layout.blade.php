@component('mail::message')

@yield('content')

<div>
    <small style="font-size: 11px; color: #ddd;">Sent date: {{ \Carbon\Carbon::now()->toString() }}</small>
</div>
@endcomponent