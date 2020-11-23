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
                    <input type="text" class="" style="border-radius: 20px;border-color: gray; width: 200px;"
                     id="user" placeholder="Search">
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
                            <li class="ml-15 mt-10 mb-8"><a href="#" class="hb-hidden">Another action</a></li>
                            <li class="ml-15 mt-10 mb-8"><a href="#" class="hb-hidden">Something else here</a></li>
                            
                            <li class="ml-15 mt-10 mb-8" class="hb-hidden"><a href="#">Separated link</a></li>
                            </ul>
                            </div>
                            
                            
                        </div>
                    </div>
                </div>
                @else
                <div class="navbar-end">
                    <div class="navbar-item">
                        <div class="buttons">
                            <a class="button is-primary is-outlined" href="{{ route('register') }}">
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

</body>

</html>
