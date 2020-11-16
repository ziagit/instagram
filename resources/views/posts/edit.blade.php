@extends('layouts.app')

@section('content')

<div class="card has-background-dark h100">
    <div class="card-body is-transparent">
        @if($errors->any())
        <div class="notification is-warning">
            <button class="delete"></button>
            <p>{{ $errors->first() }}</p>
        </div>
        @endif
        <form method="POST" action="{{ route('posts.update', $post->id) }}" enctype="multipart/form-data">

            <!-- CSRF Token -->
            @csrf

            <!-- Method -->
            @method('PATCH')

            <!-- Image input -->
            <div class="image-upload" style="background-image: url({{ asset('images/posts/'.$post->image) }})">
            </div>


            <!-- Description Input -->
            <div class="field">
                <label class="label has-text-white">{{ __('Description') }}</label>
                <div class="control">
                    <textarea name="description" class="textarea" placeholder="e.g. Hello world" required autofocus>{{ $post->description }}</textarea>
                </div>
            </div>

            <!-- Submit button -->
            <div class="field">
                <div class="control">
                    <button type="submit" class="button is-primary is-fullwidth is-large">
                        {{ __('Update') }}
                    </button>
                </div>
            </div>
        </form>

        <!-- Delete button -->
        <form method="POST" action="{{ route('posts.destroy', $post->id) }}">

            <!-- CSRF Token -->
            @csrf

            <!-- Method -->
            @method('DELETE')

            <!-- Submit button -->
            <div class="field">
                <div class="control">
                    <button type="submit" class="button is-danger is-fullwidth is-large">
                        {{ __('Destroy') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
