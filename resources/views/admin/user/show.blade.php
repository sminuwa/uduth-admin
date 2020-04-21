@extends('admin.app')

@section('sidebar-user', 'active')

@section('page-title')
    <div class="row">
        <div class="col-sm-4 col-3">
            <h4 class="page-title">

            </h4>
        </div>
    </div>
@endsection


@section('page-content')
    <div class="card-box profile-header">
        <div class="row">
            <div class="col-md-12">
                <div class="profile-view">
                    <div class="profile-img-wrap">
                        <div class="profile-img">
                            <a href="#"><img class="avatar" src="{{ asset('assets/img/user.jpg') }}" alt=""></a>
                        </div>
                    </div>
                    <div class="profile-basic">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="profile-info-left">
                                    <h3 class="user-name m-t-0 mb-0">
                                        <a href="{{ route('admin.user.show', $user->id) }}" style="color:#515365">
                                            {{ $user->name }}
                                        </a>
                                    </h3>
                                    <div class="text-muted">Username : <span class="custom-badge status-green">{{ $user->username }}</span> </div>
                                    <div class="staff-id">Role : {{ get_user($user->id)->role }}</div>
                                    <div >
                                        <?php
                                        $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                                        echo '<img width="60%" src="data:image/png;base64,' . base64_encode($generator->getBarcode(get_receipt_no($user->username), $generator::TYPE_CODE_128)) . '">';
                                        ?>
                                    </div>
                                    <br>
                                    @if(get_user()->role == 'admin')
                                    <div class="staff-msg"><a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-primary">Edit User</a></div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-7">
                                <ul class="personal-info">
                                    <li>
                                        <span class="title">Phone:</span>
                                        <span class="text">{{ $user->phone }}</span>
                                    </li>
                                    <li>
                                        <span class="title">Email:</span>
                                        <span class="text">{{ $user->email }}</span>
                                    </li>
                                    <li>
                                        <span class="title">Date of Birth:</span>
                                        <span class="text">{{ $user->dob }}</span>
                                    </li>
                                    {{--<li>
                                        <span class="title">Account Name:</span>
                                        <span class="text">{{ $user->account_name }}</span>
                                    </li>
                                    <li>
                                        <span class="title">Account No.:</span>
                                        <span class="text">{{ $user->account_number }}</span>
                                    </li>
                                    <li>
                                        <span class="title">Bank Name:</span>
                                        <span class="text">{{ $user->bank_name }}</span>
                                    </li>--}}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="profile-tabs">
        <ul class="nav nav-tabs nav-tabs-bottom">
            <li class="nav-item"><a class="nav-link active" href="#about-cont" data-toggle="tab">Patients</a></li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane show active" id="about-cont">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-box">
                            <div class="text-right m-b-20">
                                @if(get_user()->role == 'admin')
                                <a href="#" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Patient</a>
                                @endif
                            </div>
                            <h3 class="card-title">Patients</h3>
                            <div class="experience-box">
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
                                    @foreach(get_patients($user->id) as $patient)

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
                </div>
            </div>

        </div>
    </div>
@endsection
