@extends('layouts.app')

@section('sidebar')
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">User Account</li>
                <li class="@yield('sidebar-dashboard')">
                    <a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
                </li>

                <li class="@yield('sidebar-patient')">
                    <a href="{{ route('admin.patient.index') }}"><i class="fa fa-wheelchair"></i> <span>Patients</span></a>
                </li>

                <li class="@yield('sidebar-service')">
                    <a href="{{ route('admin.services') }}"><i class="fa fa-server"></i> <span>Procedures</span></a>
                </li>

                <li class="@yield('sidebar-search')">
                    <a href="javascript:;"><i class="fa fa-area-chart"></i> <span>Revenue</span></a>
                </li>

                <li class="@yield('sidebar-report')">
                    <a href="{{ route('admin.report.index') }}"><i class="fa fa-address-book"></i> <span>Reports</span></a>
                </li>

                <li class="@yield('sidebar-user')">
                    <a href="{{ route('admin.user.index') }}"><i class="fa fa-users"></i> <span>Users</span></a>
                </li>

                <li class="@yield('sidebar-configuration')">
                    <a href="#"><i class="fa fa-cog"></i> <span>Configurations</span></a>
                </li>

                <li>

                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out"></i>

                        <span>{{ __('Logout') }}</span>

                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>

                </li>

            </ul>
        </div>
    </div>
@endsection

@section('content')
    @yield('page-title')
    @yield('page-content')
@endsection


@section('script')

    @yield('page-script')

@endsection
