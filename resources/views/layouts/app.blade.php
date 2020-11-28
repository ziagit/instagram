<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>
    <meta property="og:site_name" content="instagram.com"/>
    <meta property="og:title" content=" Find nearly anyone to follow"/>
    <meta property="og:description"
          content="@section('og:description') Welcome to the world’s fastest following online . @show"/>
    <meta property="og:image" content="@section('og:image') {{asset('svg/photoify_logo.png')}} @show">
    <meta property="og:url" content="@section('og:url') {{ url('/') }} @show">
    <meta property="og:type" content="blog"/>
    <!-- Fonts -->

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <script src="{{asset('bootstrap/jquery.js')}}" ></script>

<script src="{{asset('bootstrap/js/bootstrap.min.js')}}" ></script>
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}"  >
   
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{asset('modal/css/uikit.min.css')}}">
   
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        Input:focus{
            outline: none;
        }
    </style>
</head>

<body style="background-color: white;">
<div class="row " style="max-width: 1200px;">
        
        <nav class="navbar " role="navigation" aria-label="main navigation"  style="position: fixed;width: 100%; ">
            <div class="navbar-90" style="width: 75%; margin-left: 15%; background-color: transparent;">
                <!-- Brand -->
            <div class="navbar-brand" style="padding-right: 35%;">
                @if(auth()->check())
                <form class="" action="">
                    <input type="text" class=""   id="user_name" name="user_name" onkeyup="getUsers(event);" style="border-radius: 20px;border-color: #ddd; width: 200px;"
                     id="user" placeholder="Search" data-toggle="dropdown" autocomplete="off">
                    <ul class="dropdown-menu" id="dropdown_menu" style="justify-content: center;width: 25%;margin-left: 20%;overflow-y: scroll;max-height: 200px;">
                    <span id="spinner_loadder">
                        <i class="fa fa-spinner" aria-hidden="true" style="margin-left: 45%;"></i>
                    </span> 
                    </ul>
                </form>
                @endif
                <a role="button" class="navbar-burger" aria-label="menu" data-target=".navbar-menu" aria-expanded="false">
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                </a>
            </div>

            <!-- Navbar-start -->
            <div id="navbar" class="navbar-menu">
                <div class="navbar-start">
                    
                    @if(Auth::check())
                    <a class="navbar-item" href="{{ url('/') }}">
                        <img src='{{ asset("svg/photoify_logo.png")}}' width="100px">
                    </a>
                    
                    
                    @endif

                </div>

                <!-- Navbar-end -->
                @if(Auth::check())
                <div class="navbar-end" >
                    <div class="navbar-item" >
                        <div class="buttons">

                            <a class="navbar-item" href="{{ route('posts') }}">
                                <i class="fas fa-home"></i>
                            </a>

                            <a class="navbar-item" href="{{ route('posts.create') }}">
                                <i class="fas fa-camera-retro"></i>
                            </a>
                            
                            <a class="navbar-item" href="{{ route('posts.following') }}">
                                <i class="fas fa-user-friends"></i>
                            </a>
                            <a class="navbar-item" href="{{ route('posts.liked') }}">
                                <i class="fas fa-heart "  ></i>
                            </a>
                            <div>
                            <figure class="image is-22x22 mp" data-toggle="dropdown">
                                <img class="is-rounded-22" src="{{ asset('images/avatar/'.auth()->user()->image) }}" draggable="false">
                            </figure>
                            <ul class="dropdown-menu">
                            <li class="ml-15 mt-10 mb-8" ><a href="/user/{{auth()->user()->id}}" class="color-dark hb-hidden"><i class="fa fa-user-circle" aria-hidden="true"> </i> Profile</a></li>
                            <li class="ml-15 mt-10 mb-8"><a href="{{route('account')}}" class="hb-hidden color-dark"><i class="fas fa-cog"></i>Settings</a></li>
                            <hr>
                            <li class="ml-15 mt-10 mb-8" class="hb-hidden">
                            <form method="POST" action="{{ route('logout') }}">
                                <!-- CSRF Token -->
                                @csrf
                                <input type="submit" class="btn btn-link mp color-dark" value="{{ __('Log Out') }}">
                            </form>
                            </li>
                            </ul>
                            </div>
                            
                            
                        </div>
                    </div>
                </div>
                @else

                @endif
            </div>
            </div>
        </nav>
        <main style="padding-top: 5%;">
            @yield('content')
        </main>
    <div class="col-md-1"></div>

    <!-- The actual snackbar -->
    <div id="snackbar">Some text some message..</div>
</div>
@include('sweetalert::alert')
@include('layouts.script')
    
    <script src="{{ asset('js/application.js') }}"></script>
    <script defer src="{{ asset('js/all.js')}}" integrity="sha384-EIHISlAOj4zgYieurP0SdoiBYfGJKkgWedPHH4jCzpCXLmzVsw1ouK59MuUtP4a1"
        crossorigin="anonymous"></script>
    <script src="{{asset('modal/js/uikit.min.js')}}"></script>

<script>
     function showMoreDescription(post,event){
        event.preventDefault();
        document.getElementById("descriptonـ"+post.id).innerHTML = post.description;
        document.getElementById("more_id"+post.id).style.display="none";
    }

    function getUsers(event){
        $("#spinner_loadder").show("fast");
        var name = $("#user_name").val();
        event.preventDefault();
        if(name != ""){
            $.ajax({
                url:"/get-users/"+name,
                type:"get",
                success:function(data){
                    $("#spinner_loadder").hide("fast");
                    if(data == ""){
                        $("#dropdown_menu").html("<p style='text-align: center;'>No results found.</p>");
                    }
                    else{
                        $("#dropdown_menu").html(data);
                    }
                },
                error:function(er){
                    $("#dropdown_menu").html('<span id="spinner_loadder">'+
                        '<i class="fa fa-spinner" aria-hidden="true" style="margin-left: 45%;"></i>'+
                    '</span>');
                }
            });
        }
        else{
            $("#dropdown_menu").html('<span id="spinner_loadder">'+
                        '<i class="fa fa-spinner" aria-hidden="true" style="margin-left: 45%;"></i>'+
                    '</span>');
        }
        
    }
</script>
</body>

</html>
