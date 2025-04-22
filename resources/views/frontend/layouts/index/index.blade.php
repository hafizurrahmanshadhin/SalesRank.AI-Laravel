@extends('frontend.app')

@section('title', 'Sign In')

@section('content')
    <div class="left-side">
        <img src="{{ asset('assets/img/logo2.png') }}" alt="Logo" class="logo" />
        <div class="form-container">
            <h1>Log In</h1>
            <p class="description">Welcome back! Please enter your details.</p>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Email Address"
                        value="{{ old('email') }}" />
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Password" />
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Sign In</button>
            </form>
        </div>
    </div>

    <div class="right-side">
        <img src="{{ asset('assets/img/signin.png') }}" alt="Sign In" class="signin-img" />
    </div>
@endsection
