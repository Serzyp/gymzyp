<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} | @yield('page_title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">

    <!--Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>


    <!--JQuery-->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>

    <!--FontAwesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.css" integrity="sha512-1hsteeq9xTM5CX6NsXiJu3Y/g+tj+IIwtZMtTisemEv3hx+S9ngaW4nryrNcPM4xGzINcKbwUJtojslX2KG+DQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.js" integrity="sha512-TsDUjQW16/G8fz4gmgTOBW2s2Oi6TPUtQ6/hm+TxZZdkQtQrK5xEFIE0rgDuz5Cl1xQU1u3Yer7K5IuuBeiCqw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!--Toastr.js-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!--Summernote-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.css" integrity="sha512-ngQ4IGzHQ3s/Hh8kMyG4FC74wzitukRMIcTOoKT3EyzFZCILOPF0twiXOQn75eDINUfKBYmzYn2AA8DkAk8veQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.js" integrity="sha512-6F1RVfnxCprKJmfulcxxym1Dar5FsT/V2jiEUvABiaEiFWoQ8yHvqRM/Slf0qJKiwin6IDQucjXuolCfCKnaJQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/lang/summernote-es-ES.min.js" integrity="sha512-HrbVl+sl/8uxyYizURRbi5F4cIKEvz9710veoBe8ah4paMAaxMMUOa4Fx4W43tHwbWsPqAhQJFzNHTa6PWAXpw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/lang/summernote-en-US.min.js" integrity="sha512-BSHjWY0wea6YsWMI87Fz/prOGRN7Ow+h0NrG25HT/UjjmpTgrcfNGXUHr4VfYiOcm1x92kYhf9yXaZyKkZ2kTw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <!--DATATABLES:  TODOS LOS CDNS HAN SIDO EXTRAIDOS DE: https://datatables.net/download/ -->

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/autofill/2.3.7/css/autoFill.bootstrap5.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.bootstrap5.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/colreorder/1.5.5/css/colReorder.bootstrap5.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.1.2/css/dataTables.dateTime.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedcolumns/4.0.2/css/fixedColumns.bootstrap5.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedheader/3.2.2/css/fixedHeader.bootstrap5.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/keytable/2.6.4/css/keyTable.bootstrap5.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowgroup/1.1.4/css/rowGroup.bootstrap5.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.2.8/css/rowReorder.bootstrap5.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/scroller/2.0.5/css/scroller.bootstrap5.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/searchbuilder/1.3.2/css/searchBuilder.bootstrap5.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/searchpanes/2.0.0/css/searchPanes.bootstrap5.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.3.4/css/select.bootstrap5.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/staterestore/1.1.0/css/stateRestore.bootstrap5.min.css"/>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/autofill/2.3.7/js/dataTables.autoFill.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/autofill/2.3.7/js/autoFill.bootstrap5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.colVis.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/colreorder/1.5.5/js/dataTables.colReorder.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/datetime/1.1.2/js/dataTables.dateTime.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/4.0.2/js/dataTables.fixedColumns.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.2.2/js/dataTables.fixedHeader.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/keytable/2.6.4/js/dataTables.keyTable.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap5.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/rowgroup/1.1.4/js/dataTables.rowGroup.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/rowreorder/1.2.8/js/dataTables.rowReorder.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/scroller/2.0.5/js/dataTables.scroller.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/searchbuilder/1.3.2/js/dataTables.searchBuilder.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/searchbuilder/1.3.2/js/searchBuilder.bootstrap5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/searchpanes/2.0.0/js/dataTables.searchPanes.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/searchpanes/2.0.0/js/searchPanes.bootstrap5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/select/1.3.4/js/dataTables.select.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/staterestore/1.1.0/js/dataTables.stateRestore.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/staterestore/1.1.0/js/stateRestore.bootstrap5.min.js"></script>


    <!-- PAYPAL -->
    <script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_CLIENT_ID') }}&currency=EUR"></script>

    <!-- FAVICON -->
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('favicons/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('favicons/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('favicons/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicons/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('favicons/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('favicons/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('favicons/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('favicons/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicons/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('favicons/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicons/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicons/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicons/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('favicons/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbarColor shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

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
                            @if (Auth::user()->role == 'user')
                                <a class="btnPremium me-4" href="{{ route('paypal.index') }}">
                                    <i class="fa-solid fa-crown crown"></i>
                                    {{ __('Unlock Premium') }}
                                </a>
                            @endif
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home') }}">{{ __('Index') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('table.index') }}">{{ __('My tables') }}</a>
                            </li>
                            @if (Auth::user()->role == 'admin')

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.home') }}">{{ __('Admin Panel') }}</a>
                                </li>

                            @endif

                            {{-- <li class="nav-item">
                                <a class="nav-link" href="{{ route('image.create') }}">{{ __('Upload Image') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('like.index') }}">{{ __('My likes') }}</a>
                            </li> --}}
                            <li>
                                <div class="container-avatar">
                                    @if (Auth::user()->image)
                                        <img src="{{ route('user.avatar',['filename' => Auth::user()->image]) }}" class="avatar" alt="Avatar usuario">
                                    @else
                                        {{-- https://pixabay.com/images/id-3331256/ --}}
                                        <img src="{{ asset('img/DefaultUser.png') }}" class="avatar" alt="Avatar usuario" />

                                    @endif
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    {{-- <a class="dropdown-item" href="{{ route('profile', ['id' => Auth::user()->id]) }}">
                                        {{ __('My profile') }}
                                    </a> --}}
                                    <a class="dropdown-item" href="{{ route('config'); }}">
                                        {{ __('Configuration') }}
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
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('info.index') }}">{{ __('Help Center') }}</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>

                                {{ __("Interface") }}
                                <i class="fa-solid fa-globe"></i>

                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{route('set_language', 'es')}}">{{ __("Spanish") }}</a>
                                <a class="dropdown-item" href="{{route('set_language', 'en')}}">{{ __("English") }}</a>
                                {{-- <a class="dropdown-item" href="{{route('set_language', 'fr')}}">{{ __("French") }}</a> --}}
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
