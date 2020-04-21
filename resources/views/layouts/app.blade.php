@guest
    @include('auth.login')
@else

<?php //include __DIR__."./app/Helpers/general.php"; ?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'UDUTHCTPPP') }}</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.png') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <!--[if lt IE 9]>
    <script src="{{ asset('assets/js/html5shiv.min.js') }}"></script>
    <script src="{{ asset('assets/js/respond.min.js') }}"></script>
    <![endif]-->
    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            #section-to-print, #section-to-print * {
                visibility: visible;
            }
            #section-to-print {
                position: fixed;
                left: 0;
                top: 0;
                width: 90%;
                margin-left:5%;
                margin-bottom:5%;
            }
        }
    </style>
</head>

<body>
<div class="loader" style="position: absolute; width:100%; height:100%; background:#ffffff;z-index:10000;">
    <div style="position:absolute;top: 50%;left:50%;">
      <img src="{{ asset('assets/img/preloader.gif') }}">
    </div>
</div>
<div class="main-wrapper">
    <div class="header">
        <div class="header-left">
            <a href="{{ url('/') }}" class="logo">
                <img src="{{ asset('assets/img/favicon.png') }}" width="35" height="30" alt="" class="img img-thumbnail"> <span>UDUTHCTPPP</span>
            </a>
        </div>
        <a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
        <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>
        <ul class="nav user-menu float-right">

            <li class="nav-item dropdown has-arrow">
                <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                        <span class="user-img"><img class="rounded-circle" src="{{ asset('assets/img/user.jpg') }}" width="40" alt="Admin">
							<span class="status online"></span></span>
                    <span>{{ Auth::user()->name }}</span>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="profile.html">My Profile</a>
                    <a class="dropdown-item" href="edit-profile.html">Edit Profile</a>
                    <a class="dropdown-item" href="settings.html">Settings</a>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">

                        {{ __('Logout') }}

                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
        <div class="dropdown mobile-user-menu float-right">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="profile.html">My Profile</a>
                <a class="dropdown-item" href="edit-profile.html">Edit Profile</a>
                <a class="dropdown-item" href="settings.html">Settings</a>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">

                    {{ __('Logout') }}

                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
    <div class="sidebar" id="sidebar">
        @yield('sidebar')
    </div>
    <div class="page-wrapper">
        <div class="content">
            @yield('content')
        </div>
    </div>

    <a id="sync-auto-trigger" href="#" data-toggle="modal" data-target="#sync_auto_trigger_model"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
    <div id="sync_auto_trigger_model" class="modal fade delete-modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="fa fa-check-square-o fa-4x text-success"></span>
                    <h3><span class="text-success"> Active connection detected. </span><br>
                        <small>Would you like to sync records?</small>
                    </h3>
                    <div class="m-t-20">
                        <a id="auto-sync-close-btn" href="javascript:;" class="btn btn-white" data-dismiss="modal">Later</a>
                        <a id="auto-sync-btn" href="javascript:;" class="btn btn-primary" style="color:#fff">Sync</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="sidebar-overlay" data-reff=""></div>
<script src="{{ asset('assets/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('assets/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/js/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
<script src="{{ asset('assets/js/Chart.bundle.js') }}"></script>
<script src="{{ asset('assets/js/chart.js') }}"></script>
<script src="{{ asset('assets/js/app.js') }}"></script>

<script>

    $(document).ready(function(){
       $(".loader").hide();
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    {{--@if(is_connected())
        @if(is_synced() == false)

        if(localStorage['auto-sync-close-btn'] != 'clicked'){
            $("#sync-auto-trigger").trigger('click');
            $("#auto-sync-close-btn").click(function(){
                localStorage['auto-sync-close-btn'] = 'clicked';
            });
        }
            // $("#sync-loader").css('display', 'block');
        @endif
    @endif--}}
</script>
@yield('script')
</body>

</html>

@endguest



