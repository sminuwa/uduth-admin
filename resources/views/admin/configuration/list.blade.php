@extends('admin.app')

@section('sidebar-configuration', 'active')

@section('page-title')
    <div class="row">
        <div class="col-sm-4 col-3">
            <h4 class="page-title">
                Configurations
            </h4>
        </div>
        <div class="col-sm-8 col-9 text-right m-b-20">
            <a href="{{ route('admin.configuration.create') }}" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Configuration</a>
        </div>
    </div>
@endsection


@section('page-content')
    <div class="row">
        <div class="col-md-8  offset-md-2">
            <div class="table-responsive">
                <table class="table table-border table-striped custom-table datatable mb-0">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th class="text-right">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach(get_configuration() as $config)

                        <tr>
                            <td>
                                <span class="fa fa-cog"></span>
                            </td>
                            <td>{{ $config->identifier }}</td>
                            <td>{{ date("jS F, Y", strtotime($config->created_at)) }}</td>
                            <td>
                                @if($config->status == 1)
                                    Active
                                    @else
                                @endif
                            </td>
                            <td class="text-right">
                                <a  href="{{ route('admin.configuration.show', $config->id) }}" class="btn btn-outline-primary btn-sm">
                                    <i class="fa fa-cog m-r-5"></i> Details
                                </a>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="delete_patient" class="modal fade delete-modal" role="dialog">
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
                function patientDel(id){
                    // alert(id);
                    $("#del" + id+ "").submit();
                }
            </script>
@endsection

