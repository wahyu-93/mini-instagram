<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container d-flex justify-content-around">
                <div>
                    <a class="navbar-brand" href="{{ route('home') }}">
                        Timeline
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>

                <div class="mt-2">
                    <form action="{{ route('user.search') }}" method="GET">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="" name="query">
                            <button class="btn btn-outline-secondary btn-sm" type="submit">Search</button>
                        </div>
                    </form>
                </div>

                <div>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">    
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ms-auto">
                            <!-- Authentication Links -->
                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                @endif
    
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item">
                                    <a href="{{ route('post.create') }}" class="nav-link">Upload Post</a>
                                </li>
    
                                <li class="nav-item">
                                    <a href="{{ route('user.show', [Auth::user()->username]) }}" class="nav-link">Profile</a>
                                </li>
    
                                <li class="nav-item">
                                    <a href="{{ route('komen.notif') }}" class="nav-link">Notifs <span class="badge bg-primary" id="notif_count" style="display: none">0</span></a>
                                    <script>
                                        fetch('/notif/count')
                                        .then(response => response.json())
                                        .then(data => {
                                            if(data.total==0){
                                                document.getElementById('notif_count').style.display = "none"
                                            }
                                            else {
                                                document.getElementById('notif_count').style.display = "inline"
                                                document.getElementById('notif_count').innerText = data.total 
                                            }
                                        })
                                        .catch(err => {
                                            console.log(err)
                                        })
                                    </script>
                                </li>
    
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->username }}
                                    </a>
    
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('user.profile.edit') }}">
                                            Edit Profile
                                        </a>
    
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
    
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>


</body>
</html>
