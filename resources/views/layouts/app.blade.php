<!DOCTYPE html>
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex" href="{{ url('/') }}">
                <div><img src="{{ asset('svg/instagram.svg') }}" alt="logo" class="pr-2"
                          style="height: 22px;border-right: 1px solid #333;"></div>
                <div class="pl-2" style="font-weight: 600; margin-top: 2px;">InstaGram</div>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>
                <div class="col-md-5">
                    <form action="" method="get">
                        <input type="text" name="search" id="search" placeholder="Search here" class="form-control"><i
                            class="fas fa-search" style="font-size: 20px;position: absolute;top: 10px;right: 24px;"></i>
                    </form>
                    <div class="row" style="width: 100%">
                        <div class="col-md-12">
                            <div id="searching"
                                 style="display:none;position: absolute;background: rgba(232,232,232,0.8);height: auto;z-index: 9999999;width:100%;padding: 5px;">

                            </div>
                        </div>
                    </div>
                </div>
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->username }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ url('/profile/'.auth()->user()->profile->id) }}">
                                    Profile
                                </a>
                                <a class="dropdown-item"
                                   href="{{ url('/profile/'.auth()->user()->profile->id.'/edit') }}">
                                    Settings
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>


                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
    <footer>
        <hr>
        <p class="text-center">All Rights Reserved &copy; 2020</p>
    </footer>
</div>
<script
    src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#search,#searching').on('keyup keydown click', function () {
            jQuery("#searching").show();
        });
        $('#searching').on('mouseleave', function () {
            jQuery("#searching").hide();
        });
        function delay(callback, ms) {
            var timer = 0;
            return function() {
                var context = this, args = arguments;
                clearTimeout(timer);
                timer = setTimeout(function () {
                    callback.apply(context, args);
                }, ms || 0);
            };
        }

        $('#search').keyup(delay(function (e) {
                var val = $("#search").val();

                $.ajax({
                    type: "GET",
                    url: "/searching/" + val,
                    async: true,
                    contentType: "application/json; charset=utf-8",
                    success: function (response) {
                        $('#searching').html('');
                        jQuery("#searching").show();
                        $('#searching').append('<ul>');
                        $.each(response.profile, function (index, value) {

                            $('#searching').append('<li style="list-style:none;margin-top: 10px;"><a href="/profile/' + response.profile[index].id + '" style="color:black;text-decoration:none;margin-left:5px;">' + '<img class="rounded-circle" style="padding-right:10px;height:50px;" src="/storage/' + response.profile[index].image + '">' + response.profile[index].title + '</li>');
                           console.log(response.profile[index].image);
                            // response.profile[index].id
                            // response.profile[index].image
                            //response.profile[index].title

                        });
                        $('#searching').append('</ul>');

                    },

                    error: function (error) {
                        console.log(error);
                    }
                });


        }, 500));


    });

</script>
@yield('scripts')
</body>
</html>
