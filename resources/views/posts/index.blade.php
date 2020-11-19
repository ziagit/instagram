@extends('layouts.app')

@section('content')
<style>
@media screen and (max-width: 1100px) {
.user_menu{
    visibility: hidden;
    clear: both;
    float: left;
    margin: 10px auto 5px 20px;
    width: 28%;
    display: none;
}
}

.auth-user-image{
    float: left;
    width: 50px;
    height: 50px;
  border-radius: 100%;
  overflow: hidden;
  background-color: blue;
}
</style>
<div class="card-container" style="align-content: center;">
   <div class="" style="float: left;
    margin-right: 28px;
    max-width: 614px;
    width: 100%;">
    @if(count($posts) > 0)
        @foreach($posts as $post)
            @include('layouts.post', $post)
        @endforeach
    @else
        @include('posts.empty')
    @endif
   </div>
   <div style="top: 60px; position: fixed;height: 100vh;
    max-width: 293px;
    right: 0;
    width: 100%;" class="user_menu">
            <div aria-labelledby="fdbdf25468ccc4 fee917d721624c">
                <div class="">
                    <div class="RR-M-  _2NjG_" aria-disabled="true" role="button" tabindex="-1">
                        <canvas class="CfWVH" height="66" width="66" style="position: absolute; top: -5px; left: -5px; width: 66px; height: 66px;"></canvas>
                        <a  href="/user/{{auth()->user()->id}}" tabindex="0" style="width: 56px; height: 56px;">
                            <img alt="hassani.esmatullah's profile picture" class="auth-user-image" data-testid="user-avatar" draggable="false" src="{{ asset('images/avatar/'.auth()->user()->image)}}">
                        </a>
                </div>
            </div>
            <div class=""><div class="" id="fefb5aa91306e4">
                <div class="">
                    <div class=""><a  href="/user/{{auth()->user()->id}}">{{auth()->user()->display_name}}</a>
                </div>
            </div>
        </div>
        <div class="" id="f24bf6035e0061">
            <div class=""><div class=""><div class="">{{auth()->user()->name}}</div>
        </div>
    </div>
</div>
</div>



@endsection
