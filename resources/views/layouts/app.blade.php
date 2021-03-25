<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sofra Admin DashBoard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('Admin/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('Admin/dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="/" class="nav-link">Home</a>
                </li>
            </ul>

            <!-- SEARCH FORM -->
            <form class="form-inline ml-3">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="Search"
                        aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
                <li>
                    <div class="pull-right">
                        <a href="#" class="btn btn-default btn-flat"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">Sign
                            out</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="/  " class="brand-link">
                <img src="{{ asset('Admin/dist/img/AdminLTELogo.jpeg') }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Sofra DashBoard</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ auth()->user()->image }}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ auth()->user()->name }}</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
              with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="{{ url(route('user.index')) }}" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    Users
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url(route('role.index')) }}" class="nav-link">
                                <i class="nav-icon fas fa-city"></i>
                                <p>
                                    Roles
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-coffee"></i>
                                <p>
                                    Restaurants
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('restaurant.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Restaurants</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('offer.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Offers</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('resturants-payments.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Payments</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    Clients
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url(route('client.index')) }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Clients</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('order.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Orders</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url(route('city.index')) }}" class="nav-link">
                                <i class="nav-icon fas fa-city"></i>
                                <p>
                                    Cities
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url(route('neighbourhood.index')) }}" class="nav-link">
                                <i class="nav-icon fas fa-city"></i>
                                <p>
                                    Neighbourhoods
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url(route('category.index')) }}" class="nav-link">
                                <i class="nav-icon fas fa-tasks"></i>
                                <p>
                                    Categories
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url(route('payment-method.index')) }}" class="nav-link">
                                <i class="nav-icon fas fa-cc-discover"></i>
                                <p>
                                    Payment Methods
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url(route('contact-us.index')) }}" class="nav-link">
                                <i class="nav-icon fas fa-envelope"></i>
                                <p>
                                    Contact Us
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url(route('setting.index')) }}" class="nav-link">
                                <i class="nav-icon fas fa-cog"></i>
                                <p>
                                    Setting
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url(route('change-password.index')) }}" class="nav-link">
                                <i class="nav-icon fas fa-cog"></i>
                                <p>
                                    Change Password
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>@yield('page_title')</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/">Home</a></li>
                                <li class="breadcrumb-item active">
                                    @yield('page_title')
                                </li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>


            <!-- Main content -->
            <section class="content">
                @yield('content')
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 3.1.0-rc
            </div>
            <strong>Copyright &copy; 2014-2020 <a href="#">Sofra</a>.</strong> All rights reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('Admin/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('Admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('Admin/dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('Admin/dist/js/demo.js') }}"></script>

    @stack('scripts')
    @stack('roles')
</body>

</html>
