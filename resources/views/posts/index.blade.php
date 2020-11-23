@extends('layouts.app')

@section('content')
<style>
@media screen and (max-width: 768px) {
.user_menu{
    visibility: hidden;
    clear: both;
    float: left;
    margin: 10px auto 5px 20px;
    width: 28%;
    display: none;
}
.navbar-90{
    width: 90% !important; margin-left: 5% !important;
}
}


</style>

<div class="row"  >
    
   <div class="col-md-8" style="left: 0;">
    <div class="card" style="
    
    width: 100%; height: 100px;"></div>
    @if(count($posts) > 0)
        @foreach($posts as $post)
            @include('layouts.post', $post)
        @endforeach
    @else
        @include('posts.empty')
    @endif
   </div>
   <div  class="user_menu col-md-4 " style="padding-left: 5%;">
        <div style="margin-top: 10px;" >

        <div class="">
            <div aria-labelledby="fdbdf25468ccc4 fee917d721624c">
                <a  href="/user/{{auth()->user()->id}}" tabindex="0" style="width: 56px; height: 56px;">
                    <img class="circle-user-image" data-testid="user-avatar" draggable="false" src="{{ asset('images/avatar/'.auth()->user()->image)}}">
                </a>
            
            </div>
            <div class="" id="fefb5aa91306e4">
                <a href="/user/{{auth()->user()->id}}" class="margin-left-10 color-dark">{{auth()->user()->display_name}}</a>
            </div>
            <div class="" id="f24bf6035e0061">
                <span class="margin-left-10">{{auth()->user()->name}}</span>
            </div>
        </div>
        <div class="" style="margin-top: 50px; width: 100%;">
            <h5 class="display-inline">Suggestions For You</h5><a style="margin-left: 50px;">more</a><br>
            <div style="margin-top: 10px; width: 100%;" >
                @foreach(Helper::getUser() as $user)
                <div style="display: inline-block; margin-top: 10px; width: 100%;">
                    <div class="display-inline">
                        <a  href="/user/{{$user->id}}" tabindex="0" style="width: 56px; height: 56px;">
                            <img alt="hassani.esmatullah's profile picture" class="circle-user-image-32" data-testid="user-avatar" draggable="false" src="{{ asset('images/avatar/'.$user->image)}}">
                        </a>
                    
                    </div>
                    <div  class="display-inline">
                        <a href="/user/{{$user->id}}" class="margin-left-10 color-dark" >{{$user->display_name}}</a><br>
                    
                        <span class="margin-left-10" style="font-size: 15px;">{{$user->name}}</span>
                    </div>
                    <div>
                        <a >Folow</a>
                    </div>
                    
                </div>
                @endforeach
            </div>
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
