@extends('user.app')

@section('sidebar-service', 'active')

@section('page-title')
    <div class="row">
        <div class="col-sm-4 col-3">
            <h4 class="page-title">
                Procedure List
            </h4>
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
                        <th>#</th>
                        <th>Name</th>
                        <th>Type</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $sno = 1; ?>
                    @foreach(get_services() as $service)
                        <tr>
                            <td>{{ $sno }}</td>
                            <td>
                                {{ $service->name }}
                            </td>
                            <td>
                            @foreach(get_service_type($service->id) as $type)
                                <table class="table mb-0" style="border:none;">
                                    <tr>
                                    <td style="border:none;">{{ $type->name }}</td>
                                    <td style="border:none;">{{ $type->amount }}</td>
                                </tr>
                                </table>
                            @endforeach
                            </td>
                        </tr>
                        <?php $sno +=1; ?>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
