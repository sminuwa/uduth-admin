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
            <h4 class="page-title">Configuration Details</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <table class="table table-bordered">
                @foreach($configuration as $config)
                    <tr>
                        <th width="50%"> {{ $config->name }} </th>
                        <td> {{ $config->value }} </td>
                        <td> {{ $config->type }} </td>
                    </tr>
                @endforeach
            </table>
            <a href="{{ route('admin.configuration.index') }}" class="btn btn-primary">Close</a>
        </div>
    </div>
@endsection


@section('page-script')

@endsection
