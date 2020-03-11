@extends('admin.app')

@section('sidebar-patient', 'active')

@section('page-title')
    <div class="row">
        <div class="col-sm-4 col-3">
            <h4 class="page-title">
                Patients
            </h4>
        </div>
        <div class="col-sm-8 col-9 text-right m-b-20">
            <a href="{{ route('admin.patient.create') }}" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Patient</a>
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
                        <th>Patient Id</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Phone</th>
                        <th>Date</th>
                        <th class="text-right">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach(get_patients() as $patient)

                        <tr>
                            <td>
                                <img width="28" height="28" src="{{ asset('assets/img/user.jpg') }}" class="rounded-circle m-r-5" alt="">
                                {{ $patient->name }}
                            </td>
                            <td>{{ $patient->uid }}</td>
                            <td>{{ $patient->age }}</td>
                            <td>{{ $patient->gender }}</td>
                            <td>{{ $patient->phone }}</td>
                            <td>{{ $patient->created_at }}</td>
                            <td class="text-right">
                                <a  href="{{ route('admin.patient.show', $patient->id) }}" class="btn btn-outline-primary btn-sm">
                                    <i class="fa fa-user-circle m-r-5"></i> Profile
                                </a>
                                <a onclick="patientDel({{$patient->id}})" href="javascript:;" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#delete_patient">
                                    <i class="fa fa-trash m-r-5"></i> Delete
                                </a>
                            </td>
                            <form id="del{{$patient->id}}" action="{{ route('admin.patient.destroy', $patient->id) }}" method="post">
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
@endsection

@section('page-script')
    <script>
        function patientDel(id){
            // alert(id);
            $("#del" + id+ "").submit();
        }
    </script>
@endsection

