<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('AdminLTE-3.1.0/plugins/fontawesome-free/css/all.min.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/ol@v8.1.0/dist/ol.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ol@v8.1.0/ol.css">

    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-3.1.0/plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.min.css"
          integrity="sha512-3JRrEUwaCkFUBLK1N8HehwQgu8e23jTH4np5NHOmQOobuC4ROQxFwFgBLTnhcnQRMs84muMh0PnnwXlPq5MGjg=="
          crossorigin="anonymous"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="{{ asset('AdminLTE-3.1.0/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminLTE-3.1.0/plugins/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminLTE-3.1.0/plugins/toastr/toastr.min.css') }}">
    <link rel="stylesheet"
          href="{{ asset('AdminLTE-3.1.0/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
          href="{{ asset('AdminLTE-3.1.0/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet"
          href="{{ asset('AdminLTE-3.1.0./plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminLTE-3.1.0/dist/css/adminlte.min.css') }}">
    <style>
        .marker {
            background-image: {{asset('img/user-1.jpg')}};
            width: 25px;
            height: 41px;
            background-size: cover;
            cursor: pointer;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-primary navbar-dark">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="" class="nav-link">Home</a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    <i class="fas fa-user-lock"></i>
                </a>
                <form id="logout-form"
                      @if(auth('driver')->check())
                          action="{{url('driver/logout')}}"
                      @elseif(auth('customer')->check())
                          action="{{url('customer/logout')}}"
                      @endif
                      method="GET">
                    @csrf
                </form>

            </li>
        </ul>
    </nav>
</div>
@include('template.sidebar')
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
@if(Auth::guard('driver')->check())
    <script>
        let currentlocationvalue;

        function getlocation() {
            navigator.geolocation.getCurrentPosition(function (position) {
                currentlocationvalue = [position.coords.longitude, position.coords.latitude];
            })
        }

        $(document).ready(function () {


            let interval = setInterval(function () {
                console.log('requested');
                getlocation();
                $.ajax({
                    type: 'POST',
                    url: '{{ url('/driver/'.Auth::guard('driver')->id().'/location') }}',
                    data: {
                        'latitude': currentlocationvalue[1],
                        'longitude': currentlocationvalue[0],
                        '_token': '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        console.log(response.msg);
                    },
                    error: function (error) {
                        console.log(error)
                        clearInterval(interval);
                    }
                });
            }, 5000);
        });
    </script>
@endif
@stack('scripts')

</body>
</html>
