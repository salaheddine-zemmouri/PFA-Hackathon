@component('mail::message')
# Hello from Hackathon

Dear Contestant, <br>
You've been invited to participate as contestant within the team <b>{{$details['team_name']}}</b> participating on Hackathon. <br>
You are already member on the plateform, login to access.

# How to get started

1. Go to <b><a href="http://127.0.0.1:8000/login">Hackathon Login Page</a></b> <br>
1. <b>Login</b> using your credentials <br>

Thanks,<br>
{{ config('app.name') }}
@endcomponent