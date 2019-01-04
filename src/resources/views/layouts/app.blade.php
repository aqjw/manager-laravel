<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta content="Admin Dashboard" name="description" />
    <meta content="Themesbrand" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App title -->
    <title>{{ config('app.name') }}</title>

    <!-- App css -->
    <link href="{{ asset('aqjw/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('aqjw/assets/css/icons.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('aqjw/assets/css/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('aqjw/assets/bootstrap4-glyphicons/css/bootstrap-glyphicons.min.css')}}" rel="stylesheet" type="text/css"/>
    @stack('css')
</head>
<body>

    <div class="header-bg">
        <header id="topnav">
            <div class="topbar-main">
                <div class="navbar-custom-bg">
                    <div class="container-fluid text-center position-relative">
                        @include('managerl::menu.main')
                    </div>
                </div>
            </div>
        </header>
    </div>

    <div class="wrapper">
        @yield('content')
    </div>

    <script src="{{ asset('aqjw/assets/js/app.js') }}"></script>

    <!-- App js -->
    @stack('js')
</body>
</html>
