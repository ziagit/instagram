@extends('layouts.app')

@section('content')
<div class="container row">
    <div class="col-md-4"></div>
    <div class="col-md-6">
        <div class="card  h100 ml-25" style="margin-left: 10px;">
            <div class="card-body is-transparent">
                <h1 class="is-size-2 is-size-4-touch ">{{ __('Login') }}</h1>
                @if($errors->any())
                <div class="notification is-warning">
                    <button class="delete"></button>
                    <p>{{ $errors->first() }}</p>
                </div>
                @endif
                <form method="POST" action="{{ route('login') }}">

                    <!-- CSRF Token -->
                    @csrf

                    <!-- Email Input -->
                    <div class="field">
                        <label class="label ">{{ __('E-Mail Address') }}</label>
                        <div class="control">
                            <input class="input" type="email" name="email" placeholder="E-mail address" value="{{ old('email') }}"
                                required autofocus autocomplete="off">
                        </div>
                    </div>

                    <!-- Password Input -->
                    <div class="field">
                        <label class="label ">{{ __('Password') }}</label>
                        <div class="control">
                            <input class="input" type="password" name="password" required>
                        </div>
                    </div>

                    <div class="columns">

                        <!-- Forgot your password link -->
                        <a class="column has-text-primary" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>


                        <!-- Remember me check -->
                        <div class="column field">
                            <div class="is-flex is-justify-end control">
                                <label class="checkbox " for="remember">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>

                                    {{ __('Remember Me?') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Submit button -->
                    <div class="field">
                        <div class="control">
                            <button type="submit" class="button is-primary is-fullwidth is-large">
                                {{ __('Login') }}
                            </button>
                        </div>
                    </div>

                    <!-- Register link -->
                    <p> {{ __('Need an account') }}?<a class="has-text-primary has-text-right" href="{{ route('register') }}">
                            {{ __('Register') }}
                        </a></p>
                                    <!-- Register link -->
                    <p> {{ __('Forgot your password?') }}<a class="has-text-primary has-text-right" href="{{ route('password.update') }}">
                            {{ __('Reset') }}
                        </a></p>
                </form>
                <div class="flex items-center justify-end mt-4">
                <a href="{{ url('authorized/google') }}">
                    <img src="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png" >
                </a>
                <a href="{{url('/authorized/facebook')}}" class="btn btn-primary">
                <i class="fab fa-facebook"></i>
                Sign with Facebook</a>

                </div>
            </div>
        </div>
    </div>
    <div class="col-md-2"></div>
</div>

@endsection
