
<!DOCTYPE html>
<html @if(App::getLocale() == 'ar') dir="rtl" @endif>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

    <link rel="stylesheet" href="{{ asset('assets/css/adminlte.min.css') }}">

    @if(App::getLocale() == 'ar')
        <link rel="stylesheet" href="{{ asset('assets/css/rtl.css') }}">
    @endif

    <style>
        .error { color: red; text-transform: capitalize}
        .fa-trash {color: red}
        li hr {
            border-top: 1px solid rgba(255, 255, 255, 0.1)
        }
    </style>

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>

            <li class="nav-item d-none d-sm-inline-block">
                @if(App::getLocale() == 'ar')
                <a href="/admin/set-locale/en" class="nav-link">الانجليزيه</a>
                @else
                    <a href="/admin/set-locale/ar" class="nav-link">Ar</a>
                @endif
            </li>

        </ul>

    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="/" class="brand-link">
            <div class="brand-text text-center font-weight-light">@lang('trans.home')</div>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->

                    <li class="nav-item active">
                        <a href="{{ action('Admin\UsersController@index') }}" class="nav-link">
                            <i class="nav-icon fas fa-user-tie"></i>
                            <p>
                                @lang('trans.users')
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ action('Admin\CompaniesController@index') }}" class="nav-link">
                            <i class="nav-icon fas fa-building"></i>
                            <p>
                                @lang('trans.companies')
                            </p>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a href="{{ action('Admin\EmployeesController@index') }}" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                @lang('trans.employees')

                            </p>
                        </a>
                    </li>

                    <li>
                        <hr>
                    </li>

                    <li class="nav-item">
                        <a href="/admin/logout" class="nav-link">
                            <i class="nav-icon fas fa-power-off"></i>
                            <p>
                                @lang('trans.logout')
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

        @yield('content')

    </div>
    <!-- /.content-wrapper -->

</div>
<!-- ./wrapper -->
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script src="{{ asset('assets/js/adminlte.js') }}"></script>

<script>
    $(document).on('click', '.dlt-link', function (e) {
        e.preventDefault();
        var link = $(this).attr('href'),
            id = $(this).data('id'),
            dltClass = ".to-dlt-" + id;
        var data = {};
        data['_token'] = "{{ csrf_token() }}";
        // data['method'] = 'delete';
        sweetAlert({
            title: "Confirm Deleting !?",
            // text: "Click On Ok To Confirm",
            type: "warning",
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true
        }, function () {
            $.ajax({
                url: link,
                data: data,
                type: 'delete',
                success: function (response) {
                    if (response.status == 1) {
                        swal("Success :)", "Row Deleted Successfully", "success");
                        //remove row from table
                        $(document).find(dltClass).remove();
                    }
                }
            });
        });
    });
</script>

</body>
</html>
