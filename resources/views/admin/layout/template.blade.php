<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="{{asset('admin/img/logo/logo.png')}}" rel="icon">
    <title>RuangAdmin - Dashboard</title>
    <link href="{{asset('admin/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin/css/ruang-admin.css')}}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @yield('style')

</head>

<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        @include('admin.layout.sidebar')
        <!-- Sidebar -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- TopBar -->
                @include('admin.layout.topbar')
                <!-- Topbar -->

                <!-- content -->
                @yield('content')
                <!---End Content-->
            </div>
        </div>
        <!-- Footer -->
        <footer class="sticky-footer bg-white">


            <div class="container my-auto py-2">
                <div class="copyright text-center my-auto">
                    <span>copyright &copy; <script>
                            document.write(new Date().getFullYear());
                        </script> - design by
                        <b>Awas - Banjir</b>
                    </span>
                </div>
            </div>
        </footer>
        <!-- Footer -->
    </div>
    </div>

    <!-- Scroll to top -->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>



    <!-- Modal Logout -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to logout?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                    <a href="login.html" class="btn btn-primary">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('admin/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('admin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    <script src="{{asset('admin/js/ruang-admin.min.js')}}"></script>
    <script src="{{asset('admin/vendor/chart.js/Chart.min.js')}}"></script>
    <!-- <script src="{{asset('admin/js/demo/chart-area-demo.js')}}"></script> -->
    @yield('script')
</body>

</html>