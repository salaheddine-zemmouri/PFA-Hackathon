@extends('layouts.dashboard-layout')

@section('title')
<title>Hackathon - Edit Profile</title>
@endsection

@section('actions')

@endsection

@section('customised-msg')

@endsection

@section('content')
<div class="col-md-9">
    <div class="card shadow-sm">
        <div class="card-header">
            <h4>Edit profile</h4>
        </div>
        <div class="card-body">
            <form id="edit_profile_form" method="POST" action="{{ route('update.profile',$user->id) }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" name="name" class="form-control  @error('name') is-invalid @enderror" id="name" value="{{ old('name',$user->name) }}">
                    @error('name')
                    <span class="invalid-feedback">
                        <strong id="name_error">{{ $message }}</strong>
                    </span> 
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email',$user->email) }}">
                    @error('start_date')
                    <span class="invalid-feedback">
                        <strong id="email_error">{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">New Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="{{ old('password') }}">
                    @error('password')
                    <span class="invalid-feedback">
                        <strong id="password_error">{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <hr>
                <div class="text-center">
                    <button class="btn btn-success" type="submit">
                        <i class="fas fa-lock"></i> Save Changes
                    </button>
                    <a href="{{route('competitions.index')}}" class="btn btn-danger">
                        <i class="fas fa-trash"></i> Discard Changes
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('pagination')
    
@endsection

@section('customised-modal')

@endsection

@section('customised-js')
  
@endsection