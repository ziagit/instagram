@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    <p>Hello dear sir/madam</p>
                    <p>Hope you to be fine</p>
                    <p>Click to change the following link to verify your account</p>
                    <a href="{{url('/verify-user-email')}}/{{$email}}/{{$id}}">Confirm to veriry</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection