@extends('admin.app')

@section('sidebar-dashboard', 'active')

@section('page-title')
    <div class="row">
        <div class="col-sm-4 col-3">
            <h4 class="page-title">

            </h4>
        </div>
    </div>
@endsection


@section('page-content')



    <div class="row">
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
            <div class="dash-widget">
                <span class="dash-widget-bg1"><i class="fa fa-stethoscope" aria-hidden="true"></i></span>
                <div class="dash-widget-info text-right">
                    <h3>{{ get_patients(null, date('Y-m-d'))->count()  }}</h3>
                    <span class="">Today's Patients</span>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
            <div class="dash-widget">
                <span class="dash-widget-bg1"><i class="fa fa-stethoscope"></i></span>
                <div class="dash-widget-info text-right">
                    <h3>{{ get_patients(null, date('Y-m'))->count() }}</h3>
                    <span class="">{{ date('F Y') }}'s Patients</span>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
            <div class="dash-widget">
                <span class="dash-widget-bg1"><i class="fa fa-stethoscope" aria-hidden="true"></i></span>
                <div class="dash-widget-info text-right">
                    {{--                    <h3>{{ count(get_payment_by_user(get_user()->id)) }}</h3>--}}
                    <h3>{{ get_patients(null, date('Y'))->count() }}</h3>
                    <span class="">{{ date('Y') }}'s Patients</span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
            <div class="dash-widget">
                <span class="dash-widget-bg1"><i class="fa fa-money" aria-hidden="true"></i></span>
                <div class="dash-widget-info text-right">
                    <h3>&#8358; {{ number_format(get_payment_by_user(null, date('Y-m-d'))->sum('service_amount')) }}</h3>
                    <span class="">Today's Revenue</span>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
            <div class="dash-widget">
                <span class="dash-widget-bg1"><i class="fa fa-money"></i></span>
                <div class="dash-widget-info text-right">
                    <h3>&#8358; {{ number_format(get_payment_by_user(null, date('Y-m'))->sum('service_amount')) }}</h3>
                    <span class="">{{ date('F Y') }}'s Revenue</span>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
            <div class="dash-widget">
                <span class="dash-widget-bg1"><i class="fa fa-money" aria-hidden="true"></i></span>
                <div class="dash-widget-info text-right">
                    {{--                    <h3>{{ count(get_payment_by_user(get_user()->id)) }}</h3>--}}
                    <h3>&#8358; {{ number_format(get_payment_by_user(null, date('Y'))->sum('service_amount')) }}</h3>
                    <span class="">{{ date('Y') }}'s Revenue</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-6 col-lg-6 col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="chart-title">
                        <h4>Patient Stats</h4>
                        <div class="float-right">
                            <div class="dropdown dropdown-action show">
                                <form id="form-patient-stats-year" action="{{route('user.patient.get_stats_year')}}" method="post">
                                    @csrf
                                    <select name="year" id="patient-stats-year" class="form-control-sm" style="border: none; background: none; color:#00884e;">
                                        @if(isset($year))<option>{{ $year }}</option>@endif
                                        @foreach(get_patient_distinct_year() as $distinct_year)
                                            <option>{{ $distinct_year }}</option>
                                        @endforeach
                                    </select>
                                </form>
                            </div>
                        </div>
                    </div>
                    <canvas id="patient-stats"></canvas>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-6 col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="chart-title">
                        <h4>Revenue Stats</h4>
                        <span class="float-right">
                            <div class="dropdown dropdown-action show">
                                <form id="form-revenue-stats-year" action="{{route('user.patient.get_stats_year')}}" method="post">
                                    @csrf
                                    <select name="year" id="revenue-stats-year" class="form-control-sm" style="border: none; background: none; color:#00884e;">
                                        @if(isset($year))<option>{{ $year }}</option>@endif
                                        @foreach(get_patient_distinct_year() as $distinct_year)
                                            <option>{{ $distinct_year }}</option>
                                        @endforeach
                                    </select>
                                </form>
                            </div>
                        </span>
                    </div>
                    <canvas id="revenue-stats"></canvas>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-12 col-md-6 col-lg-8 col-xl-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title d-inline-block">Invoices (Today)</h4>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="d-none">
                            <tr>
                                <th>Patient Name</th>
                                <th>Doctor Name</th>
                                <th>Timing</th>
                                <th class="text-right">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(get_payment_by_user(null, date('Y-m-d'))->orderBy('id', 'DESC')->get() as $payment)
                                <tr>
                                    <td style="min-width: 200px;">
                                        <a class="avatar" href="{{ route('user.patient.payment.invoice', ['patient'=> $payment->patient_id, 'payment'=>$payment->id]) }}">B</a>
                                        <h2>
                                            <a href="{{ route('user.patient.payment.invoice', ['patient'=> $payment->patient_id, 'payment'=>$payment->id]) }}">
                                                {{ get_patient_by_id($payment->patient_id)->get()[0]->name }}
                                                <span>{{ get_services($payment->service_id)->get()[0]->name }}</span>
                                            </a>
                                        </h2>
                                    </td>
                                    <td>
                                        <h5 class="time-title p-0">Type & Amount</h5>
                                        <p>{{ get_service_type($payment->service_id)[0]->name }} {{ $payment->service_amount }}</p>
                                    </td>
                                    <td>
                                        <h5 class="time-title p-0">Time</h5>
                                        <p>{{ $payment->created_at }}</p>
                                    </td>
                                    <td class="text-right">
                                        <a href="{{ route('user.patient.payment.invoice', ['patient'=> $payment->patient_id, 'payment'=>$payment->id]) }}" class="btn btn-outline-primary take-btn">Preview</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4 col-xl-4">
            <div class="card member-panel">
                <div class="card-header bg-white">
                    <h4 class="card-title mb-0">Patients (Today)</h4>
                </div>
                <div class="card-body">
                    <ul class="contact-list">
                        @foreach(get_patients(null, date('Y-m-d'))->orderBy('id', 'DESC')->get() as $patient)
                            <li>
                                <div class="contact-cont">
                                    <div class="float-left user-img m-r-10">
                                        <a href="{{ route('user.patient.show', $patient->id) }}" title="{{ $patient->name }}"><img src="{{ asset('assets/img/user.jpg') }}" alt="" class="w-40 rounded-circle"></a>
                                    </div>
                                    <div class="contact-info">

                                        <a href="{{ route('user.patient.show', $patient->id) }}" title="{{ $patient->name }}" style="color:#000000;">
                                        <span class="contact-name text-ellipsis">
                                            {{ $patient->name }}
                                        </span>
                                        </a>

                                        <span class="contact-date">{{ $patient->address }}</span>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="card-footer text-center bg-white">
                    <a href="{{ route('user.patient.index') }}" class="text-muted">View all Patients</a>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('page-script')
    <script>

        $(document).ready(function(){

            $("#patient-stats-year").change(function(){
                $("#form-patient-stats-year").submit();
            });
            $("#revenue-stats-year").change(function(){
                $("#form-revenue-stats-year").submit();
            });

                @if(!isset($year))
                {{ $year = null }}
                @endif

            let patientChart = {
                    labels: ['Jan', 'Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
                    datasets: [{
                        label: 'Patients',
                        backgroundColor: '#00884f90',
                        borderColor: '#00884f90',
                        borderWidth: 1,
                        data: [
                            {{ get_patient_stats_data(null,get_patient_stats_label('Jan', $year))->count() }},
                            {{ get_patient_stats_data(null,get_patient_stats_label('Feb', $year))->count() }},
                            {{ get_patient_stats_data(null,get_patient_stats_label('Mar', $year))->count() }},
                            {{ get_patient_stats_data(null,get_patient_stats_label('Apr', $year))->count() }},
                            {{ get_patient_stats_data(null,get_patient_stats_label('Mar', $year))->count() }},
                            {{ get_patient_stats_data(null,get_patient_stats_label('Jun', $year))->count() }},
                            {{ get_patient_stats_data(null,get_patient_stats_label('Jul', $year))->count() }},
                            {{ get_patient_stats_data(null,get_patient_stats_label('Aug', $year))->count() }},
                            {{ get_patient_stats_data(null,get_patient_stats_label('Sep', $year))->count() }},
                            {{ get_patient_stats_data(null,get_patient_stats_label('Oct', $year))->count() }},
                            {{ get_patient_stats_data(null,get_patient_stats_label('Nov', $year))->count() }},
                            {{ get_patient_stats_data(null,get_patient_stats_label('Dec', $year))->count() }}
                        ]
                    }]
                };

            let revenueChart = {
                labels: ['Jan', 'Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
                datasets: [{
                    label: 'Patient',
                    backgroundColor: '#00884f80',
                    borderColor: '#00884f80',
                    borderWidth: 1,
                    data: [
                        {{ get_revenue_stats_data(null,get_revenue_stats_label('Jan', $year))->sum('service_amount') }},
                        {{ get_revenue_stats_data(null,get_revenue_stats_label('Feb', $year))->sum('service_amount') }},
                        {{ get_revenue_stats_data(null,get_revenue_stats_label('Mar', $year))->sum('service_amount') }},
                        {{ get_revenue_stats_data(null,get_revenue_stats_label('Apr', $year))->sum('service_amount') }},
                        {{ get_revenue_stats_data(null,get_revenue_stats_label('Mar', $year))->sum('service_amount') }},
                        {{ get_revenue_stats_data(null,get_revenue_stats_label('Jun', $year))->sum('service_amount') }},
                        {{ get_revenue_stats_data(null,get_revenue_stats_label('Jul', $year))->sum('service_amount') }},
                        {{ get_revenue_stats_data(null,get_revenue_stats_label('Aug', $year))->sum('service_amount') }},
                        {{ get_revenue_stats_data(null,get_revenue_stats_label('Sep', $year))->sum('service_amount') }},
                        {{ get_revenue_stats_data(null,get_revenue_stats_label('Oct', $year))->sum('service_amount') }},
                        {{ get_revenue_stats_data(null,get_revenue_stats_label('Nov', $year))->sum('service_amount') }},
                        {{ get_revenue_stats_data(null,get_revenue_stats_label('Dec', $year))->sum('service_amount') }}
                    ]
                }]
            };

            let pt = document.getElementById('patient-stats').getContext('2d');
            window.myBar = new Chart(pt, {
                type: 'bar',
                data: patientChart,
                options: {
                    responsive: true,
                    legend: {
                        display: false,
                    }
                }
            });

            let rv = document.getElementById('revenue-stats').getContext('2d');
            window.myBar = new Chart(rv, {
                type: 'line',
                data: revenueChart,
                options: {
                    responsive: true,
                    legend: {
                        display: false,
                    }
                }
            });
        })
    </script>
@endsection

