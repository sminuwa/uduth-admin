@extends('admin.app')

@section('sidebar-service', 'active')

@section('page-title')
    <div class="row">
        <div class="col-sm-4 col-3">
            <h4 class="page-title">
                Procedure List
            </h4>
        </div>
        <div class="col-sm-8 col-9 text-right m-b-20">
            @if(get_user()->role == 'admin')
            <a href="javascript:;" class="btn btn btn-primary btn-rounded float-right" data-toggle="modal" data-target="#add_service"><i class="fa fa-plus"></i> Add Procedures</a>
            @endif
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
                        <th>Name</th>
                        <th>Type</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach(get_services() as $service)
                        <tr>

                            <td>
                                {{ $service->name }}
                            </td>
                            <td>
                            @foreach(get_service_type($service->id) as $type)
                                <table class="table mb-0" style="border:none;background-color:#ffffff09 !important;">
                                    <form id="delete-btn{{$type->id}}" style="margin: 0;padding: 0;" action="{{ route('admin.service.type.destroy', $type->id) }}" method="post">
                                        @csrf
                                        {{method_field("DELETE")}}
                                        <input type="hidden" value="{{ $type->id }}" name="id">
                                    </form>
                                    <tr style="box-shadow:none;background-color:#ffffff09 !important;">
                                    <td style="border:none;">{{ $type->name }}</td>
                                    <td style="border:none;">{{ $type->amount }}</td>
                                    <td style="border:none;" class="right-action">
{{--                                        <a href="{{ route('admin.service.type.edit', $type->id) }}" class="btn btn-outline-primary btn-sm"> <i class="fa fa-edit"></i></a>--}}
                                        @if(get_user()->role == 'admin')
                                        <a href="javascript:;" onclick="document.getElementById('delete-btn{{$type->id}}').submit();" class="btn btn-outline-danger btn-sm"> <i class="fa fa-trash"></i></a>
                                        @endif
                                    </td>
                                </tr>
                                </table>
                            @endforeach
                            </td>
                            <td class="right-action">
                                @if(get_user()->role == 'admin')
                                <a href="#" onclick="addType('{{ $service->id }}')" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add_type"><i class="fa fa-plus"></i></a>
{{--                                <a href="#" onclick="deleteServiceTrigger('{{ $service->id }}')" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_service"><i class="fa fa-trash"></i> </a>--}}
                                @endif
                            </td>
                            <form id="sdel{{$service->id}}" method="POST" action="{{ route('admin.service.destroy', $service->id) }}">
                                @csrf
                                {{ method_field("DELETE") }}
                            </form>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div id="add_service" class="modal fade delete-modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    {{--                    <img src="assets/img/sent.png" alt="" width="50" height="46">--}}
                    <h3 id="service_name" style="margin:15px;">Add new procedure</h3>
                    <form method="POST" action="{{ route('admin.service.store') }}">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-8 offset-md-2">
                                <input class="form-control" type="text" name="name" placeholder="Name" required>
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
    <div id="add_type" class="modal fade delete-modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    {{--                    <img src="assets/img/sent.png" alt="" width="50" height="46">--}}
                    <h3 id="service_name" style="margin:15px;">Add new procedure item</h3>
                    <form method="POST" action="{{ route('admin.service.type.store') }}">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-8 offset-md-2">
                                <input class="form-control" type="hidden" name="service_id" id="type-service_id">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-8 offset-md-2">
                                <input class="form-control" type="text" name="name" placeholder="Name" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-8 offset-md-2">
                                <input class="form-control" type="text" name="amount" placeholder="Amount" required>
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
    <div id="delete_service" class="modal fade delete-modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <img src="{{ asset('assets/img/sent.png') }}" alt="" width="50" height="46">
                    <h3 id="service_name">Are you sure you want delete this procedure?</h3>
                    <form method="POST" action="{{ route('admin.service.destroy', 1) }}">
                        @csrf
                        {{ method_field("DELETE") }}
                        <div class="m-t-20">
                            <a href="#" class="btn btn-white" data-dismiss="modal">Cancel</a>
                            <button onclick="deleteService(1)" type="submit" class="btn btn-danger">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('page-script')
    <script>
        function addType(id){
            $("#type-service_id").val(id)
        }

        function deleteProcedure(id){
            $("#service_id").val(id)
        }

        function deleteServiceTrigger(id){
            $("#delete_service").trigger('click');
            // $("#delete_service").val(id)
        }

        function deleteService(id){
            $("#sdel" + id+ "").submit();
        }
    </script>
@endsection
