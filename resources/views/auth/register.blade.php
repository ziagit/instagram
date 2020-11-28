@extends('layouts.app')

@section('content')
<div class="container row">
    <div class="col-md-4"></div>
    <div class="col-md-6 col-sm-12">
        <div class="card h100 ml-25" style="margin-left: 10px;">
            <div class="card-body is-transparent">
                <h1 class="is-size-2 is-size-4-touch ">{{ __('Sign up') }}</h1>
                @if($errors->any())
                <div class="notification is-warning">
                    <button class="delete"></button>
                    <p>{{ $errors->first() }}</p>
                </div>
                @endif
                <form method="POST" action="{{ route('registeruser') }}">

                    <!-- CSRF Token -->
                    @csrf

                    <!-- Username Input -->
                    <div class="field">
                        <label class="label ">{{ __('Your username') }}</label>
                        <div class="control">
                            <input class="input" type="text" name="name" placeholder="Username" value="{{ old('name') }}"
                                required autofocus autocomplete="off">
                        </div>
                    </div>

                    <!-- Email input -->
                    <div class="field">
                        <label class="label ">{{ __('E-Mail Address') }}</label>
                        <div class="control">
                            <input class="input" type="email" name="email" placeholder="E-Mail Address" value="{{ old('email') }}"
                                required autocomplete="off">
                        </div>
                    </div>

                    <!-- Passsword input -->
                    <div class="field">
                        <label class="label ">{{ __('Password') }}</label>
                        <div class="control">
                            <input class="input" type="password" name="password" required autocomplete="off">
                        </div>
                    </div>

                    <!-- Passsword confirm input -->
                    <div class="field">
                        <label class="label ">{{ __('Confirm Password') }}</label>
                        <div class="control">
                            <input class="input" type="password" name="password_confirmation"  required>
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
    </div>
    <div class="col-md-2"></div>
</div>

@endsection
