<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Fonts -->

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <script src="{{asset('bootstrap/jquery.js')}}" ></script>

<script src="{{asset('bootstrap/js/bootstrap.min.js')}}" ></script>
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}"  >
   
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    
   
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body style="background-color: white;">
<div class="row ">
        <div class="col-md-1"></div>
    <div id="app" class="col-md-10">
        <nav class="navbar navbar-90" role="navigation" aria-label="main navigation"  style="position: fixed;width: 80%;">
            <!-- Brand -->
            <div class="navbar-brand" style="padding-right: 10%;">
                <form class="" action="">
                    <input type="text" class="" id="user_name" name="user_name" onkeyup="getUsers(event);" style="border-radius: 20px;border-color: gray; width: 200px;"
                     id="user" placeholder="Search" data-toggle="dropdown" autocomplete="off">
                    <ul class="dropdown-menu" id="dropdown_menu" style="justify-content: center;width: 25%;margin-left: 32%;overflow-y: scroll;max-height: 200px;">
                    <span id="spinner_loadder">
                        <i class="fa fa-spinner" aria-hidden="true" style="margin-left: 45%;"></i>
                    </span> 
                    </ul>
                </form>
                <a role="button" class="navbar-burger" aria-label="menu" data-target=".navbar-menu" aria-expanded="false">
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                </a>
            </div>

            <!-- Navbar-start -->
            <div id="navbar" class="navbar-menu">
                <div class="navbar-start">
                    <a class="navbar-item" href="{{ url('/') }}">
                        <img src='{{ asset("svg/photoify_logo.png")}}' width="100px">
                    </a>
                    @if(Auth::check())
                    <div class="navbar-item">
                        
                    </div>
                    
                    
                    
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
                                <input type="submit" class="btn btn-link mp" value="{{ __('Log Out') }}">
                            </form>
                            </li>
                            </ul>
                            </div>
                            
                            
                        </div>
                    </div>
                </div>
                @else
                <div class="navbar-end">
                    <div class="navbar-item">
                        <div class="buttons">
                            <a class="button is-primary is-outlined" href="{{ route('register') }}" >
                                {{ __('Sign up') }}
                            </a>
                            <a class="button is-primary" href="{{ route('login') }}">
                                {{ __('Log in') }}
                            </a>
                        </div>
                    </div>
                </div>

                @endif
            </div>
        </nav>

        <main style="padding-top: 5%;">
            @yield('content')
        </main>
    </div>
    <div class="col-md-1"></div>
</div>

    <script src="{{ asset('js/app.js') }}"></script>
    <script defer src="{{ asset('js/all.js')}}" integrity="sha384-EIHISlAOj4zgYieurP0SdoiBYfGJKkgWedPHH4jCzpCXLmzVsw1ouK59MuUtP4a1"
        crossorigin="anonymous"></script>
<script>
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
