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


</style>

<div class="card-container"  >
    
   <div class="" style="
    margin-right: 28px;
    max-width: 614px;
    width: 100%;">
    <div class="card" style="
    margin-right: 28px;
    max-width: 614px;
    width: 100%; height: 100px;"></div>
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
        <div class="container">
            <div aria-labelledby="fdbdf25468ccc4 fee917d721624c">
                <a  href="/user/{{auth()->user()->id}}" tabindex="0" style="width: 56px; height: 56px;">
                    <img alt="hassani.esmatullah's profile picture" class="circle-user-image" data-testid="user-avatar" draggable="false" src="{{ asset('images/avatar/'.auth()->user()->image)}}">
                </a>
            
            </div>
            <div class="" id="fefb5aa91306e4">
                <a href="/user/{{auth()->user()->id}}" class="margin-left-10 color-dark">{{auth()->user()->display_name}}</a>
            </div>
            <div class="" id="f24bf6035e0061">
                <span class="margin-left-10">{{auth()->user()->name}}</span>
            </div>
        </div>
        <div class="container" style="margin-top: 50px; width: 100%;">
            <h5 class="display-inline">Suggestions For You</h5><a style="margin-left: 50px;">more</a><br>
            <div style="margin-top: 10px; width: 100%;" >
                @foreach(Helper::getUser() as $user)
                <div style="display: inline-block; margin-top: 10px; width: 100%;">
                    <div aria-labelledby="fdbdf25468ccc4 fee917d721624c" class="display-inline">
                        <a  href="/user/{{$user->id}}" tabindex="0" style="width: 56px; height: 56px;">
                            <img alt="hassani.esmatullah's profile picture" class="circle-user-image-32" data-testid="user-avatar" draggable="false" src="{{ asset('images/avatar/'.$user->image)}}">
                        </a>
                    
                    </div>
                    <div id="fefb5aa91306e4" class="display-inline">
                        <a href="/user/{{$user->id}}" class="margin-left-10 color-dark">{{$user->display_name}}</a>
                    </div>
                    <div class="" id="f24bf6035e0061">
                        <span class="margin-left-10">{{$user->name}}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>


</div>

<script>
    function showMoreDescription(post,event){
        event.preventDefault();
        document.getElementById("descriptonـ"+post.id).innerHTML = post.description;
        document.getElementById("more_id"+post.id).style.display="none";
    }
</script>

@endsection
