@component('mail::message')
# Hello from Hackathon

You've been invited as an evaluator to <b>{{$details['competition_name']}}</b> on Hackathon.
There are your credentials to login.

# How to get started

1. Go to <b><a href="http://127.0.0.1:8000/login">Hackathon Login Page</a></b> <br>
1. Enter your email: <b>{{$details['evaluator_email']}}</b> <br>
1. Enter your password: <b>{{$details['evaluator_password']}}</b> <br>
1. That's your dashboard. Go to <b>{{$details['competition_name']}}</b> <br>

Thanks,<br>
{{ config('app.name') }}
@endcomponent