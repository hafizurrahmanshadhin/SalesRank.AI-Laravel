@extends('frontend.app')

@section('title', 'Sign In')

@section('content')
    <div class="left-side">
        <img src="{{ asset('assets/img/logo2.png') }}" alt="Logo" class="logo" />
        <div class="form-container">
            <h1>Log In</h1>
            <p class="description">Welcome back! Please enter your details.</p>
            <form>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" placeholder="Email Address" />
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" placeholder="Password" />
                </div>
                <div class="remember-forgot">
                    <div style="display: flex; align-items: center;">
                        <label for="remember"></label>
                    </div>
                    <div>
                        <a href="#" style="color: #0070f3;">Forgot password</a>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Sign In</button>
            </form>
        </div>
    </div>

    <div class="right-side">
        <img src="{{ asset('assets/img/signin.png') }}" alt="Sign In" class="signin-img" />
    </div>
@endsection
