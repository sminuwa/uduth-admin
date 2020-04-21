@extends('admin.app')

@section('sidebar-report', 'active')

@section('page-title')
    <div class="row">
        <div class="col-sm-4 col-3">
            <h4 class="page-title">
                Reports
            </h4>
        </div>
        <div class="col-sm-8 col-9 text-right m-b-20">
            <a href="{{ route('admin.report.create') }}" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> New Report</a>
        </div>
    </div>
@endsection

@section('page-content')



    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-border table-striped custom-table datatable mb-0">
                    <thead>
                    <tr>
                        <th>Sender</th>
                        <th>Phone</th>
                        <th>Subject</th>
                        <th>Read Status</th>
                        <th>Date</th>
                        <th class="text-right">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach(get_reports() as $report)
                        <tr>
                            <td>
                                <img width="28" height="28" src="{{ asset('assets/img/user.jpg') }}" class="rounded-circle m-r-5" alt="">
                                {{ get_user($report->user_id)->name }}
                            </td>
                            <td>{{--{{ get_user($report->user_id)->phone }}--}}</td>
                            <td>{{ $report->subject }}</td>
                            <td>
                                @if($report->status == 1)
                                    <span class="custom-badge status-green">
                                        <i class="fa fa-check-circle"></i>
                                    </span>
                                @else
                                    <span class="custom-badge status-red">
                                        <i class="fa fa-times"></i>
                                    </span>
                                @endif
                            </td>
                            <td>{{ $report->created_at }}</td>
                            <td class="text-right">
                                <a  href="{{ route('admin.report.show', $report->id) }}" class="btn btn-outline-primary btn-sm">
                                    <i class="fa fa-book m-r-5"></i> Read Report
                                </a>
                            </td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection


