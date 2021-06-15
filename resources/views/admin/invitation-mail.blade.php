@component('mail::message')
# Hello from Hackathon

Dear Evaluator, <br>
You've been invited to participate as an evaluator on the competition <b>{{$details['competition_name']}}</b> on Hackathon. <br>
There are your credentials to login.

# How to get started

1. Go to <b><a href="http://127.0.0.1:8000/login">Hackathon Login Page</a></b> <br>
1. Enter your email: <b>{{$details['evaluator_email']}}</b> <br>
1. Enter your default password: <b>{{$details['evaluator_password']}}</b> <br>
1. That's your dashboard. Go to <b>{{$details['competition_name']}}</b> <br>

# Don't forget to change your default password

Thanks,<br>
{{ config('app.name') }}
@endcomponent