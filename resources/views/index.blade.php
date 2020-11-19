@extends('layouts.app')

@section('content')
<div class="index-container">

    <div class="message ">
        <div class="index-header is-flex is-justify-center w100">
        <img src='svg/photoify_logo.png'>
        </div>
        <p class="is-size-4 has-text-white has-text-centered mb">{{ __('Create an account today and experience the
            future of social media') }}</p>
        <div class="buttons has-addons">
            <a class="button is-large is-primary is-outlined" href="{{ route('register') }}">
                <strong>{{ __('Sign up') }}</strong>
            </a>
            <a class="button is-large is-primary" href="{{ route('login') }}">
                {{ __('Log in') }}
            </a>
        </div>
    </div>
</div>

@endsection
