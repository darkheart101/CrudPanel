<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}

    <title>Crud Panel - Dashboard</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Font Awesome -->
    {{-- <link href="{{ asset('css/all.min.css') }}" rel="stylesheet" type="text/css"> --}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('crud_panel/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('crud_panel/css/dashboard.min.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">
        <!--<main class="py-4">-->
        <main>

                <nav class="navbar navbar-expand-md navbar-light bg-gradient-primary navbar-laravel">
                        <div class="container">
                            <a class="navbar-brand text-white" href="">
                                Crud Panel
                            </a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <!-- Left Side Of Navbar -->
                                <ul class="navbar-nav mr-auto">

                                </ul>

                                <!-- Right Side Of Navbar -->
                                {{-- @auth
                                <ul class="navbar-nav ml-auto">
                                    <!-- Authentication Links -->
                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link text-white dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            User <span class="caret"></span>
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" data-toggle="modal" href="#password_form">
                                                Change Password
                                            </a>
                                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </div>
                                    </li>
                                </ul>
                                @endauth --}}
                            </div>
                        </div>
                    </nav>
            <div class="float-left" style="padding-top:2px;">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" style="padding-top:5px;">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
              <div class="sidebar-brand-icon">
                <i class="fas fa-book-reader"></i>
              </div>
              <div class="sidebar-brand-text mx-3">Crud Panel</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
              <a class="nav-link" href="{{ url('/dashboard') }}">
                <i class="fas fa-columns"></i>
                <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
              Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
              <a class="nav-link collapsed" href="{{ url('/models') }}" >
                <i class="fas fa-book"></i>
                <span>Models</span>
              </a>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
              <a class="nav-link collapsed" href="{{ url('/authors') }}" >
                <i class="fas fa-pen-nib"></i>
                <span>Migrations</span>
              </a>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
              <a class="nav-link collapsed" href="{{ url('/borrowers') }}" >
                <i class="fas fa-user-edit"></i>
                <span>Controllers</span>
              </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            {{-- <div class="sidebar-heading">
              Addons
            </div> --}}

            <!-- Nav Item - Pages Collapse Menu -->
            {{-- <li class="nav-item">
              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                <i class="fas fa-fw fa-folder"></i>
                <span>Borrowings</span>
              </a>
              <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                  <h6 class="collapse-header">Actions:</h6>
                  <a class="collapse-item" href="{{ url('/borrowings') }}" >Borrowings List</a>

                  @if (\Request::is('borrowings'))
                    <a class="collapse-item" data-toggle="modal" href="#borrowing_form">New Borrowing</a>
                  @endif

                </div>
              </div>
            </li> --}}

            {{-- <li class="nav-item">
                <a class="nav-link collapsed" href="{{ url('/register') }}" >
                <i class="fas fa-user-edit"></i> Register User
              </a>
            </li> --}}

          </ul>
          <!-- End of Sidebar -->
            </div>
            <div>

                    <form action="" method="post">
                            @csrf
                            <input type="text" name="model_name">
                            <input type="submit" name="btn_submit_model" value="Submit">
                    </form>
            </div>
        </main>
    </div>
</body>
</html>