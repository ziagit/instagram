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
@include('layouts.script')

<div class="row " style="" >
    
   <div class="col-md-10">
    <div class="card" style="
    
    height: 100px; margin-left: 0;"></div>
   
    <div id="menu_infinite">
    @if(count($posts) > 0)
        @include('layouts.post', $posts)
    @else
        @include('posts.empty')
    @endif
    </div>
   </div>
   <div  class="user_menu col-md-2 " style="padding-left: 5%;">
        <div style="margin-top: 10px; position: fixed;">

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
                <h5 class="display-inline">Suggestions For You</h5><a style="margin-left: 22%;">more</a><br>
                <div style="margin-top: 10px; width: 100%;" >
                    @foreach(Helper::getUser()['users']->take(6) as $user)
                    <div class="row" style="display: inline-block; margin-top: 10px; width: 100%;">
                        <div class="col-md-4">
                            <a  href="/user/{{$user->id}}" tabindex="0" style="width: 56px; height: 56px;">
                                <img alt="profile picture" class="circle-user-image-32" data-testid="user-avatar" draggable="false" src="{{ asset('images/avatar/'.$user->image)}}">
                            </a>
                        </div>
                        <div  class="col-md-8">
                            <div class="row">
                                <div class="col-md-8">
                                    <a href="/user/{{$user->id}}" class="margin-left-10 color-dark" >
                                    @if($user->display_name == ""){{$user->email}}
                                    @else
                                    {{$user->display_name}}
                                    @endif
                                    </a><br>
                            
                                    <span class="margin-left-10" style="font-size: 15px;">{{$user->name}}</span>
                                </div>
                                <div class="col-md-2">
                                <form method="POST" action="{{ route('account.follow', ['id'=>$user->id]) }}" class="w100">
                                    @csrf
                                    <input type="submit" class="btn btn-link mp color-dark" value="{{ __('Follow') }}">
                                </form>
                                </div>
                            </div>
                        </div>
                            
                        
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>


</div>
<div class="ajax-load text-center" style="display:none">
	<p><img src="{{asset('loading.gif')}}" style="width: 50px;">Loading More post</p>
</div>

<script>
    function showMoreDescription(post,event){
        event.preventDefault();
        document.getElementById("descriptonـ"+post.id).innerHTML = post.description;
        document.getElementById("more_id"+post.id).style.display="none";
    }
    var page = 1;
	$(window).scroll(function() {
	    if($(window).scrollTop() + $(window).height() >= $(document).height()) {
	        page++;
	        loadMoreData(page);
	    }
	});


	function loadMoreData(page){
        var url = "{{substr(Request::url(),strrpos( Request::url(), '/' ))}}";
        if(url != "/posts"){
            url = "/posts"+url;
        }
        $.ajax(
	        {
	            url: url+'?page=' + page,
                type: "get",
                data:{'scrool_view':true},
	            beforeSend: function()
	            {
	                $('.ajax-load').show();
	            }
	        })
	        .done(function(data)
	        {
	            if(data == ""){
	                $('.ajax-load').html("No more posts found");
	                return;
                }
                if(data != ""){
                    $("#menu_infinite").append(data);
                }
	        })
	        .fail(function(jqXHR, ajaxOptions, thrownError)
	        {
	              alert('server not responding...');
	        });
	}
</script>

@endsection
