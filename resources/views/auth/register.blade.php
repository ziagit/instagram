@extends('layouts.app')

@section('content')

<div class="card has-background-dark h100">
    <div class="card-body is-transparent">
        <h1 class="is-size-2 is-size-4-touch has-text-white">{{ __('Sign up') }}</h1>
        @if($errors->any())
        <div class="notification is-warning">
            <button class="delete"></button>
            <p>{{ $errors->first() }}</p>
        </div>
        @endif
        <form method="POST" action="{{ route('register') }}">

            <!-- CSRF Token -->
            @csrf

            <!-- Username Input -->
            <div class="field">
                <label class="label has-text-white">{{ __('Your username') }}</label>
                <div class="control">
                    <input class="input" type="text" name="name" placeholder="JohnDoe" value="{{ old('name') }}"
                        required autofocus>
                </div>
            </div>

            <!-- Email input -->
            <div class="field">
                <label class="label has-text-white">{{ __('E-Mail Address') }}</label>
                <div class="control">
                    <input class="input" type="email" name="email" placeholder="john.doe@example.com" value="{{ old('email') }}"
                        required>
                </div>
            </div>

            <!-- Passsword input -->
            <div class="field">
                <label class="label has-text-white">{{ __('Password') }}</label>
                <div class="control">
                    <input class="input" type="password" name="password" required>
                </div>
            </div>

            <!-- Passsword confirm input -->
            <div class="field">
                <label class="label has-text-white">{{ __('Confirm Password') }}</label>
                <div class="control">
                    <input class="input" type="password" name="password_confirmation" required>
                </div>
            </div>

            <!-- Submit button -->
            <div class="field">
                <div class="control">
                    <button type="submit" class="button is-primary is-fullwidth is-large">
                        {{ __('Register') }}
                    </button>
                </div>
            </div>

            <!-- Login form link -->
            <p>{{ __('Have an account?') }}<a class="has-text-primary has-text-right" href="{{ route('login') }}">
                    {{ __('Login') }}
                </a></p>
        </form>
    </div>
</div>
@endsection
