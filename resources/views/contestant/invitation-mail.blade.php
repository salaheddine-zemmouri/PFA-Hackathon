@component('mail::message')
# Hello from Hackathon

Dear contestant,<br>
You've been invited to participate as contestant within the team <b>{{$details['team_name']}}</b> participating on Hackathon. <br>
There are your credentials to login.

# How to get started

1. Go to <b><a href="http://127.0.0.1:8000/login">Hackathon Login Page</a></b> <br>
1. Enter your email: <b>{{$details['contestant_email']}}</b> <br>
1. Enter your default password: <b>{{$details['contestant_password']}}</b> <br>

# Don't forget to change your default password

Thanks,<br>
{{ config('app.name') }}
@endcomponent