<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Blank Page</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/AdminLTE.css') }}">
    <link rel="stylesheet" href="{{ asset('css/_all-skins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">

        <header class="main-header">
            <!-- Logo -->
            <a href="{{ route('home_admin') }}" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>A</b>LT</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>Admin</b>LTE</span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>

                <ul class="nav navbar-nav navbar-right" style="margin-right: 10px">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Hi
                            {{ Auth::user()->fullname }} <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            {{-- <li><a href="#">Thông tin</a></li> --}}
                            <li><a href="{{ route('logout') }}">Thoát tài khoản</a></li>
                        </ul>
                    </li>
                </ul>

            </nav>
        </header>
        <!-- =============================================== -->
        <!-- Left side column. contains the sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- /.search form -->
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu" data-widget="tree">
                    <!--Quản Lí Tài khoản-->
                    <li class="treeview">
                        <a href="#">
                            <i class="far fa-user-circle"></i> <span>Quản Lí Tài Khoản</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{ route('add-user-get') }}"><i class="far fa-circle"></i> Thêm Tài
                                    Khoản</a></li>
                        </ul>
                    </li>
                    <!--Quản Lí Sản Phẩm-->
                    <li class="treeview">
                        <a href="#">
                            <i class="fas fa-mobile-alt"></i> <span>Quản Lí Sản Phẩm</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{ route('product_home') }}"><i class="far fa-circle"></i>Danh Sách Sản
                                    Phẩm</a></li>
                            <li><a href="{{ route('add-product-get') }}"><i class="far fa-circle"></i>Thêm Sản
                                    Phẩm</a></li>
                            <li><a href="{{ route('lst-product-detail') }}"><i class="far fa-circle"></i>Danh Sách
                                    chi tiết sản phẩm</a></li>
                            <li><a href="{{ route('add-product-detail-get') }}"><i class="far fa-circle"></i>Thêm
                                    Chi Tiết Sản Phẩm</a></li>

                    </li>
                </ul>
                </li>

                <!--Quản Lí Slider-->
                <li class="treeview">
                    <a href="#">
                        <i class="far fa-indent"></i> <span>Quản Lí Slider</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route('lst_slider') }}"><i class="far fa-circle"></i>Danh Sách Slider</a>
                        </li>
                        <li><a href="{{ route('add-slider-get') }}"><i class="far fa-circle"></i>Thêm Slider</a>
                        </li>
                    </ul>
                </li>

                <!--Quản Lí Danh Mục Sản Phẩm-->
                <li class="treeview">
                    <a href="#">
                        <i class="far fa-indent"></i> <span>Quản Lí Category</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route('lst_category') }}"><i class="far fa-circle"></i>Danh Sách Loại</a>
                        </li>
                        <li><a href="{{ route('add-cate-get') }}"><i class="far fa-circle"></i>Thêm Loại Sản
                                Phẩm</a>
                        </li>
                    </ul>
                </li>

                {{-- <li>
                        <a href="">
                            <i class="fa fa-th"></i> <span>Widgets</span>
                            <span class="pull-right-container">
                                <small class="label pull-right bg-green">Hot</small>
                            </span>
                        </a>
                    </li> --}}

                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>
        <!-- =============================================== -->
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('body')
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 2.4.0
            </div>
            <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
            reserved.
        </footer>

    </div>
    <!-- ./wrapper -->

    <!-- jQuery 3 -->

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/adminlte.min.js') }}"></script>
</body>

</html>
