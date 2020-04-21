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

                <li class="@yield('sidebar-revenue')">
                    <a href="javascript:;" data-toggle="modal" data-target="#generate-revenue"><i class="fa fa-area-chart"></i> <span>Revenue</span></a>
                </li>

                <li class="@yield('sidebar-report')">
                    <a href="{{ route('admin.report.index') }}"><i class="fa fa-address-book"></i> <span>Reports</span></a>
                </li>

                @if(get_user()->role !='user')
                <li class="@yield('sidebar-user')">
                    <a href="{{ route('admin.user.index') }}"><i class="fa fa-users"></i> <span>Users</span></a>
                </li>
                @endif

                @if(get_user()->role =='admin')
                    <li class="@yield('sidebar-configuration')">
                        <a href="{{ route('admin.configuration.index') }}"><i class="fa fa-cog"></i> <span>Configurations</span></a>
                    </li>
                @endif
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
    <div id="generate-revenue" class="modal fade delete-modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    {{--                    <img src="assets/img/sent.png" alt="" width="50" height="46">--}}
                    <h3 id="service_name" style="margin:15px;">Add new procedure</h3>
                    <form method="POST" action="{{ route('admin.revenue.get_revenue') }}">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-8 offset-md-2">
                                <div class="row">
                                    <div class="col-md-6">
                                        <select class="form-control" type="text" name="month" required>
                                            <option>01</option>
                                            <option>02</option>
                                            <option>03</option>
                                            <option>04</option>
                                            <option>05</option>
                                            <option>06</option>
                                            <option>07</option>
                                            <option>08</option>
                                            <option>09</option>
                                            <option>10</option>
                                            <option>11</option>
                                            <option>12</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <select class="form-control" type="text" name="year" required>
                                            @foreach(get_payment_distinct_year() as $year)
                                                <option>{{ $year }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="m-t-20">
                            <a href="#" class="btn btn-white" data-dismiss="modal">Cancel</a>
                            <button type="submit" class="btn btn-primary" style="color:white;">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="filter-patients" class="modal fade delete-modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    {{--                    <img src="assets/img/sent.png" alt="" width="50" height="46">--}}
                    <h3 id="service_name" style="margin:15px;">Filter Patient Records</h3>
                    <form method="POST" action="{{ route('admin.patient.filter') }}">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-10 offset-md-1">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="service_id">Procedure</label>
                                        <select class="form-control" type="text" id="service_id" name="service_id" required>
                                            <option value="all">All</option>
                                            @foreach(get_services() as $service)
                                                <option value="{{ $service->id }}">{{ $service->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="service_type">Type</label>
                                        <select class="form-control" type="text" id="service_type" name="service_type" required>
                                            <option value="all">All</option>
                                            <option value="Adult">Adult</option>
                                            <option value="Child">Child</option>
                                        </select>
                                    </div>
                                </div>
                                <div style="height:30px;"></div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="date_from">From</label>
                                        <input class="form-control" type="date" id="date_from" name="date_from">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="date_to">To</label>
                                        <input class="form-control" type="date" id="date_to" name="date_to">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="m-t-20">
                            <a href="#" class="btn btn-white" data-dismiss="modal">Cancel</a>
                            <button type="submit" class="btn btn-primary" style="color:white;">Filter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')

    @yield('page-script')

@endsection
