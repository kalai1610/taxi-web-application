<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>

    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('AdminLTE-3.1.0/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-3.1.0/plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.min.css"
          integrity="sha512-3JRrEUwaCkFUBLK1N8HehwQgu8e23jTH4np5NHOmQOobuC4ROQxFwFgBLTnhcnQRMs84muMh0PnnwXlPq5MGjg=="
          crossorigin="anonymous"/>
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-3.1.0/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminLTE-3.1.0/plugins/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminLTE-3.1.0/plugins/toastr/toastr.min.css') }}">
    <link rel="stylesheet"
          href="{{ asset('AdminLTE-3.1.0/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
          href="{{ asset('AdminLTE-3.1.0/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('AdminLTE-3.1.0/dist/css/adminlte.min.css') }}">
</head>
<style>
    .error{
        color:red;
    }

</style>
<body>
<div class="wrapper">
    <nav class=" navbar navbar-expand navbar-primary navbar-dark text-gray-dark">
        <div class="nav-item">
            <img class="img-circle img-md ml-3" src="{{asset('img/logo.png')}}">
        </div>
        <div class="nav-item ">
            <h2 class="text-gray-dark"><strong>Flywheel</strong></h2>
        </div>
        <div class="nav-item ">
            <h4>{{$user}}</h4>
        </div>
        <div class="navbar-nav ml-auto">
            <div class="nav-item">
                <a href="{{url('/driver/login')}}" class="nav-link text-gray-dark">Driver</a>
            </div>
            <div class="nav-item ml-1">
                <a href="{{url('/customer/login')}}" class="nav-link text-gray-dark">Customer</a>
            </div>
        </div>
    </nav>
</div>
<div>
    @yield('content')
</div>
<script src="{{ asset('AdminLTE-3.1.0/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('AdminLTE-3.1.0/dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('AdminLTE-3.1.0/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('AdminLTE-3.1.0/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('AdminLTE-3.1.0/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('AdminLTE-3.1.0/plugins/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('AdminLTE-3.1.0/plugins/select2/js/select2.full.min.js') }}"></script>
<!-- InputMask -->
<script src="{{ asset('AdminLTE-3.1.0/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('AdminLTE-3.1.0/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
<!-- date-range-picker -->
<script src="{{ asset('AdminLTE-3.1.0/plugins/daterangepicker/daterangepicker.js') }}"></script><!-- Bootstrap 4 -->
<script src="{{ asset('AdminLTE-3.1.0/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/js/tempusdominus-bootstrap-4.min.js"
    integrity="sha512-k6/Bkb8Fxf/c1Tkyl39yJwcOZ1P4cRrJu77p83zJjN2Z55prbFHxPs9vN7q3l3+tSMGPDdoH51AEU8Vgo1cgAA=="
    crossorigin="anonymous"></script>

@stack('scripts')

</body>
</html>
