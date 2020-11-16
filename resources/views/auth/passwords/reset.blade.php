@extends('layouts.app')

@section('content')
<div class="card has-background-dark h100">
    <div class="card-body is-transparent">
        <h1 class="is-size-2 is-size-4-touch has-text-white">{{ __('Reset Password') }}</h1>
        @if($errors->any())
        <div class="notification is-warning">
            <button class="delete"></button>
            <p>{{ $errors->first() }}</p>
        </div>
        @endif
        <form method="POST" action="{{ route('password.update') }}">

            <!-- CSRF Token -->
            @csrf

            <!-- Reset token -->
            <input type="hidden" name="token" value="{{ $token }}">

            <!-- Email Input -->
            <div class="field">
                <label class="label has-text-white">{{ __('E-Mail Address') }}</label>
                <div class="control">
                    <input class="input" type="email" name="email" value="{{ $email ?? old('email') }}" required
                        autofocus>
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
                        {{ __('Reset') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
