<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- <link rel="stylesheet" href="{{ asset('css/loader.css')}}"> -->

        {{-- datatables start --}}
            {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"/> --}}
            {{-- <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet"> --}}
            <link href="{{ asset('/data-tables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
            <link href="{{ asset('/data-tabvles/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
        {{-- datatables end --}}

        {{-- toaster message alert start --}}
        <link rel="stylesheet" href="{{ asset('vendor/yoeunes/toastr/toastr.min.css') }}">
        {{-- toaster message alert end --}}

        {{-- cv icon url start --}}
        <!-- Add this to your layout head section -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-GLhlTQ8i1UqFWRg/j94AraInYISWbOT+CA5Vc5e9iNEaa/ySc5l5MvHlXU/FZBp" crossorigin="anonymous">

    {{-- <!-- DataTables Responsive CSS --> --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css"/>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        {{-- cv icon url end --}}


        @stack('page-css')



</head>

<body id="page-top">

    {{-- <!-- Page Wrapper --> --}}
    <div id="wrapper">

            {{-- <!-- Sidebar --> --}}
            @include('../partials/sidebar')
            {{-- <!-- End of Sidebar --> --}}
        {{-- <!-- Content Wrapper --> --}}
        <div id="content-wrapper" class="d-flex flex-column">

            {{-- <!-- Main Content --> --}}
            <div id="content">

            

                {{-- <!-- Topbar --> --}}
                    @include('../partials/header')
                {{-- <!-- End of Topbar --> --}}

                @yield('main-content')

            </div>
            {{-- <!-- End of Main Content --> --}}

                {{-- <!-- Footer --> --}}
                    @include('../partials/footer')
                {{-- <!-- End of Footer --> --}}

        </div>
        {{-- <!-- End of Content Wrapper --> --}}

    </div>
    {{-- <!-- End of Page Wrapper --> --}}




    {{-- <!-- Scroll to Top Button--> --}}
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    {{-- <!-- Logout Modal--> --}}
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{ route('logout')  }}">Logout</a>
                </div>
            </div>
        </div>
    </div>




    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>



        {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> --}}
        <script src="{{ asset('/data-tables/js/jquery/jqueryjquery.js') }}"></script>
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script> --}}
        {{-- <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script> --}}
        <script src="{{ asset('/data-tables/js/jquery/jquery.dataTables.min.js') }}"></script>

        <script src="https://cdn.datatables.net/1.11.7/js/jquery.dataTables.min.js"></script>
        {{-- <script src="https://cdn.datatables.net/1.11.7/js/dataTables.bootstrap4.min.js"></script> --}}
        {{-- <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script> --}}
        <script src="{{ asset('data-tables/js/jquery/dataTables.responsive.min.js')}}"></script>

        {{-- <!-- DataTables Responsive JavaScript --> --}}
        <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>


            {{-- toaster alert start --}}
            <script src="{{ asset('vendor/yoeunes/toastr/toastr.min.js') }}"></script>
            {{-- toaster alert end --}}
            {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script> --}}
            {{-- <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script> --}}


            <script>
                 // <!-- Toastr scripts -->

    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
            </script>
    @stack('scripts')



</body>

</html>
