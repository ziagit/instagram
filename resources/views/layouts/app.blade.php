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
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar" role="navigation" aria-label="main navigation">
            <!-- Brand -->
            <div class="navbar-brand">
                <a class="navbar-item" href="{{ url('/') }}">
                    {!! file_get_contents(public_path('svg/photoify_logo.svg')) !!}
                </a>
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
                    <div class="navbar-item">
                        <a class="button is-info" href="{{ route('posts.create') }}">
                            <i class="fas fa-camera-retro"></i>{{ __('Create') }}
                        </a>
                    </div>
                    <a class="navbar-item" href="{{ route('posts') }}">
                        <i class="far fa-newspaper"></i>{{ __('New') }}
                    </a>
                    <a class="navbar-item" href="{{ route('posts.following') }}">
                        <i class="fas fa-user-friends"></i>{{ __('Following') }}
                    </a>
                    <a class="navbar-item" href="{{ route('posts.liked') }}">
                        <i class="fas fa-heart"></i>{{ __('Liked') }}
                    </a>
                    @endif

                </div>

                <!-- Navbar-end -->
                @if(Auth::check())
                <div class="navbar-end">
                    <div class="navbar-item">
                        <div class="buttons">
                            <a class="button is-primary is-outlined" href="{{ route('account.show', ['id' => Auth::id()]) }}">
                                {{ __('My Account') }}
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                <!-- CSRF Token -->
                                @csrf
                                <input type="submit" class="button is-primary" value="{{ __('Logout') }}">
                            </form>
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

        <main>
            @yield('content')
        </main>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.6.3/js/all.js" integrity="sha384-EIHISlAOj4zgYieurP0SdoiBYfGJKkgWedPHH4jCzpCXLmzVsw1ouK59MuUtP4a1"
        crossorigin="anonymous"></script>
</body>

</html>
