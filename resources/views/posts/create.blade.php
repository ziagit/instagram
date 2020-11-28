@extends('layouts.app')

@section('content')
<div class="container row">
<div class="col-md-4"></div>
<div class="col-md-6">  
    <div class="card has-background-dark h100" style="margin-left: 10px;">
        <div class="card-body is-transparent">
            @if($errors->any())
            <div class="notification is-warning">
                <button class="delete"></button>
                <p>{{ $errors->first() }}</p>
            </div>
            @endif
            <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">

                <!-- CSRF Token -->
                @csrf

                <!-- Method -->

                @method('PUT')

                <!-- Image input -->
                <div class="image-upload">
                    <div class="file is-boxed">
                        <label class="file-label">
                            <input class="file-input" type="file" name="image">
                            <span class="file-cta">
                            <span class="file-icon">
                                <i class="fas fa-upload"></i>
                            </span>
                            <span class="file-label">
                                Choose a file…
                            </span>
                            </span>
                        </label>
                    </div>
                </div>


                <!-- Description Input -->
                <div class="field">
                    <label class="label ">{{ __('Description') }}</label>
                    <div class="control">
                        <textarea name="description" class="textarea" placeholder="e.g. Hello world" maxlength="128" required autofocus></textarea>
                    </div>
                </div>

                <!-- Submit button -->
                <div class="field">
                    <div class="control">
                        <button type="submit" class="button is-primary is-fullwidth is-large">
                            {{ __('Upload') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="col-md-2"></div>
</div>
@endsection
