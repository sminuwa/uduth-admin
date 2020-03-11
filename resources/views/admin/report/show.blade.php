@extends('admin.app')

@section('sidebar-report', 'active')

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
        <div class="col-lg-8 offset-lg-2">
            <h4 class="page-title">Report Details</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <table class="table table-bordered">
                <tr>
                    <th width="100">Sender: </th>
                    <td> {{ get_user()->name }} </td>
                </tr>
                <tr>
                    <th>Subject: </th>
                    <td> {{ $report->subject }} </td>
                </tr>
                <tr>
                    <th>Description: </th>
                    <td style="height: 200px;"> {{ $report->description }} </td>
                </tr>
                <tr>
                    <th>Status: </th>
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
                <tr>
                    <th>Sent Time: </th>
                    <td> {{ $report->created_at }} </td>
                </tr>
                </tr>
            </table>
            <a href="{{ route('admin.report.index') }}" class="btn btn-primary">Close Report</a>
        </div>
    </div>
@endsection


@section('page-script')

@endsection
