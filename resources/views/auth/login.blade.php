@extends('layouts.app')

@section('content')
<div class="card has-background-dark h100">
    <div class="card-body is-transparent">
        <h1 class="is-size-2 is-size-4-touch has-text-white">{{ __('Login') }}</h1>
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
                <label class="label has-text-white">{{ __('E-Mail Address') }}</label>
                <div class="control">
                    <input class="input" type="email" name="email" placeholder="john.doe@example.com" value="{{ old('email') }}"
                        required autofocus>
                </div>
            </div>

            <!-- Password Input -->
            <div class="field">
                <label class="label has-text-white">{{ __('Password') }}</label>
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
                        <label class="checkbox has-text-white" for="remember">
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
    </div>
</div>
@endsection
