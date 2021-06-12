@component('mail::message')
# Hello from Hackathon

You've been invited as an evaluator to <b>{{$details['competition_name']}}</b> on Hackathon.
You are already member on the plateform, login to access.

# How to get started

1. Go to <b><a href="http://127.0.0.1:8000/login">Hackathon Login Page</a></b> <br>
1. <b>Login</b> using your credentials <br>
1. That's your dashboard. Go to <b>{{$details['competition_name']}}</b> <br>

Thanks,<br>
{{ config('app.name') }}
@endcomponent