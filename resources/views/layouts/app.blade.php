<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>
    {{-- Open graph tags --}}
    <meta property="instagram:site_name" content="{{config('app.url')}}"/>
    <meta property="instagram:title" content=" Instagram ."/>
    <meta property="instagram:description"
          content=" Welcome to the world’s fastest growing online social media to comunicate with another persone."/>
    <meta property="instagram:image" content=" {{ asset('svg/photoify_logo.png')}}">
    <meta property="instagram:url" content=" {{ url('/') }}">
    <meta property="instagram:type" content="blog"/>
    <link rel="shortcut icon" href="{{ asset('svg/photoify_logo.png')}}" type="image/x-icon">
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
                    <input type="text" class=""   id="user_name" name="user_name" onkeyup="getUsers(event);" style="border-radius: 20px;border-color: #ddd; width: 200px;border: solid 1px;font-size: 11px;padding: 8px;"
                     id="user" placeholder="Search" data-toggle="dropdown" autocomplete="off">
                    <ul class="dropdown-menu search-dropdown"  >
                        <li id="dropdown_menu"></li>
                        <span id="spinner_loadder" style="display: none;align-items: center;">
                            <img src="{{asset('loading.gif')}}" style="width: 15px;margin-left: 45%;">
                        </span>
                        <p id="no-data" style="text-align: center;"></p> 
                    </ul>
                </form>

                <a role="button" class="navbar-burger" id="navbar-burger" onclick="showMobilemenu(event);" aria-label="menu" data-target=".navbar-menu" aria-expanded="false">
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                </a>
                @endif
                
            </div>

            <!-- Navbar-start -->
            <div id="navbar" class="navbar-menu" style="align-items: center;">
                <div class="navbar-start mobile-navbar-menu">
                    
                    @if(Auth::check())
                    <a class="navbar-item" href="{{ url('/') }}">
                        <img src='{{ asset("svg/photoify_logo.png")}}' style="max-height: 2.3rem;" width="100px">
                    </a>
                    
                    
                    @endif

                </div>

                <!-- Navbar-end -->
                @if(Auth::check())
                <div class="navbar-end" >
                    <div class="navbar-item" >
                        <div class="buttons mobile-navbar-menu" >

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
                            @if(auth()->user()->social_path != "")
                            <img class="is-rounded-22" src="{{ auth()->user()->social_path }}" draggable="false">
                            @else
                            <img class="is-rounded-22" src="{{ asset('images/avatar/'.auth()->user()->image) }}" draggable="false">
                            @endif
                            </figure>
                            <ul class="dropdown-menu profile-dropdown">
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

    <!-- The actual snackbar -->
    <div id="snackbar">Some text some message..</div>
        </main>
        
    <div class="col-md-1"></div>

</div>
@include('sweetalert::alert')
@include('layouts.script')
    
    <script src="{{ asset('js/application.js') }}"></script>
    <script defer src="{{ asset('js/all.js')}}" integrity="sha384-EIHISlAOj4zgYieurP0SdoiBYfGJKkgWedPHH4jCzpCXLmzVsw1ouK59MuUtP4a1"
        crossorigin="anonymous"></script>
    <script src="{{asset('modal/js/uikit.min.js')}}"></script>

</body>

</html>
