@extends('layouts.app')

@section('content')
<div class="user-container">
    <div class="user-info">
        <div class="is-flex is-v-center">
            <figure class="image is-96x96">
                <img class="is-rounded" src="{{ asset('images/avatar/'.$user->image) }}">
            </figure>
            <div>
                <h1 class="title">
                    {{ $user->display_name !== NULL ? $user->display_name : $user->name }}
                </h1>
                <h2 class="subtitle">
                    {{ '@'.$user->name }}
                </h2>
            </div>
        </div>
    </div>
    <div class="user-biography">
        <p>{{ $user->biography }}</p>
    </div>
    <div class="user-button">
        @if($user->id !== Auth::id())
        <form method="POST" action="{{ route('account.follow', ['id'=>$user->id]) }}" class="w100">
            @csrf
            @if(!$followed)
            <input type="submit" class="button is-link is-outlined is-fullwidth" value="{{ __('Follow') }}">
            @else
            <input type="submit" class="button is-danger is-outlined is-fullwidth" value="{{ __('Unfollow') }}">
            @endif
        </form>
        @else
        <a href="{{ route('account') }}" class="button is-dark is-outlined is-fullwidth"><span class="icon"><i class="fas fa-cog"></i></span><span>{{
                __('Settings') }}</span></a>
        @endif
    </div>
</div>
<div class="card-container">
    @if(count($user->posts) > 0)
        @foreach($user->posts as $post)
            @include('layouts.post', $post)
        @endforeach
    @else
        @include('posts.empty')
    @endif
</div>
@endsection
