@extends('layouts.app')

@section('content')
<div class="row container" style="" >
@if(count($posts) > 0)

    <div class="col-md-2 col-sm-12"></div>
   <div class="col-md-6">
    <div class="card" style="
    
    height: 100px; width: 100%;"></div>
   
    <div id="menu_infinite">
        @foreach($posts as $post)
            @include('layouts.post', $post)
        @endforeach
    </div>
   </div>
   <div  class="user_menu col-md-3 " style="padding-left: 10%;">
        <div style="margin-top: 10px; position: fixed;">

            <div class="">
                <div aria-labelledby="fdbdf25468ccc4 fee917d721624c">
                    <a  href="/user/{{auth()->user()->id}}" tabindex="0" style="width: 56px; height: 56px;">
                        @if(auth()->user()->social_path != "")
                        <img class="circle-user-image" data-testid="user-avatar" draggable="false" src="{{ auth()->user()->social_path}}">
                        @else
                        <img class="circle-user-image" data-testid="user-avatar" draggable="false" src="{{ asset('images/avatar/'.auth()->user()->image)}}">
                        @endif
                    </a>
                
                </div>
                <div class="" id="fefb5aa91306e4">
                    <a href="/user/{{auth()->user()->id}}" class="margin-left-10 color-dark">{{auth()->user()->display_name}}</a>
                </div>
                <div class="" id="f24bf6035e0061">
                    <span class="margin-left-10">{{auth()->user()->name}}</span>
                </div>
            </div>
            <div class="row" style="margin-top: 50px;">
                <h5 class="display-inline">Suggestions For You</h5>
                <a class="uk-button " href="#modal-overflow" uk-toggle  style="margin-left: 15%;">more</a>
                <br>
                <div style="margin-top: 10px; width: 100%;" >
                    @foreach(Helper::getUser()['users']->take(5) as $user)
                    <div class="row" style="display: inline-block; margin-top: 10px; width: 100%;">
                        <div class="col-md-4">
                            <a  href="/user/{{$user->id}}" tabindex="0" style="width: 56px; height: 56px;">
                            @if($user->social_path != "")
                                <img alt="profile picture" class="circle-user-image-32" data-testid="user-avatar" draggable="false" src="{{ $user->social_path }}">
                            @else
                            <img alt="profile picture" class="circle-user-image-32" data-testid="user-avatar" draggable="false" src="{{ asset('images/avatar/'.$user->image)}}">
                            @endif
                            </a>
                        </div>
                        <div  class="col-md-8">
                            <div class="row">
                                <div class="col-md-8">
                                    <a href="/user/{{$user->id}}" class="margin-left-10 color-dark" >
                                    @if($user->display_name == ""){{$user->name}}
                                    @else
                                    {{$user->display_name}}
                                    @endif
                                    </a><br>
                            
                                    <span class="margin-left-10" style="font-size: 15px;">{{Helper::getUser()['status']}}</span>
                                </div>
                                <div class="col-md-2" >
                                <form method="POST" action="{{ route('account.follow', $user->id) }}" class="w100">
                                    @csrf
                                    <button type="submit" class="btn btn-link mp color-dark" style="margin-left: 0;">
                                        {{__('Follow')}}
                                    </button>
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
    @include("posts.modal")

@else

<div class="col-md-4"></div>
<div class="col-md-6">
    @include('posts.empty')
</div>
<div class="col-md-2"></div>
@endif

</div>

<div class="image-load text-center" style="display:none">
	<p><img src="{{asset('loading.gif')}}" style="width: 25px;">Loading More post</p>
</div>

<script>
    
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
	                $('.image-load').show();
	            }
	        })
	        .done(function(data)
	        {
	            if(data == ""){
	                $('.image-load').html("No more posts found");
	                return;
                }
                if(data != ""){
                    $("#menu_infinite").append(data);
                }
	        })
	        .fail(function(jqXHR, ajaxOptions, thrownError)
	        {
                showToast("server not responding or check your network connection...");
	        });
	}

      //Like posts with fetch

function likeFunction(id){
    var csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    var button = document.getElementById("button"+id);
    var likes = document.getElementById("likes"+id);
    if (button.classList.contains('liked')) {
        likes.innerHTML = parseInt(likes.innerHTML) - 1;
    } else {
        likes.innerHTML = parseInt(likes.innerHTML) + 1;
    }
    button.classList.toggle("liked");

        var formData = new FormData();
        formData.append("_token",csrf);
        var xmlHttp = new XMLHttpRequest();
        xmlHttp.onreadystatechange = function()
        {
            if(xmlHttp.readyState == 4 && xmlHttp.status == 200)
            {
                try {
                console.log("arry");
                } catch(err) {
                    console.log(err.message + " in " + xmlHttp.responseText);
                    return;
                }
                
            }
        }
        xmlHttp.open("post", "/posts/"+id); 
        xmlHttp.send(formData);
}
</script>

@endsection
