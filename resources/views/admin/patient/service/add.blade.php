@extends('admin.app')

@section('sidebar-patient', 'active')

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
                                        <a href="{{ route('admin.patient.show', $patient->id) }}" style="color:#515365">
                                            {{ $patient->name }}
                                        </a>
                                    </h3>
                                    <div class="text-muted">Patient ID : <span class="custom-badge status-green">{{ $patient->uid }}</span> </div>
                                    <div class="staff-id">Patient Type : {{ $patient->patient_type }}</div>
                                    <div style="height:30px;"></div>
                                    <div class="staff-msg"><a href="{{ route('admin.patient.edit', $patient->id) }}" class="btn btn-primary">Edit Patient</a></div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <ul class="personal-info">
                                    <li>
                                        <span class="title">Phone:</span>
                                        <span class="text">{{ $patient->phone }}</span>
                                    </li>
                                    <li>
                                        <span class="title">Email:</span>
                                        <span class="text">{{ $patient->email }}</span>
                                    </li>
                                    <li>
                                        <span class="title">Age:</span>
                                        <span class="text">{{ $patient->age }}</span>
                                    </li>
                                    <li>
                                        <span class="title">Address:</span>
                                        <span class="text">{{ $patient->address }}</span>
                                    </li>
                                    <li>
                                        <span class="title">Gender:</span>
                                        <span class="text">{{ $patient->gender }}</span>
                                    </li>
                                    <li>
                                        <span class="title">Companion:</span>
                                        <span class="text">{{ $patient->companion }}</span>
                                    </li>
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
            <li class="nav-item"><a class="nav-link active" href="#about-cont" data-toggle="tab">Procedures</a></li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane show active" id="about-cont">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-box">
                            <h3 class="card-title">Procedures</h3>
                            <div class="experience-box">
                                <div class="row">
                                    <div class="col-lg-8 offset-lg-2">
                                        <form action="{{ route('admin.patient.store.service', $patient->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label for="service">Procedures <span class="text-danger">*</span></label>
                                                                <select name="service" id="service" type="text" class="form-control select" required>
                                                                    <option value=""> -- Procedures -- </option>
                                                                    @foreach(get_services() as $service)
                                                                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6 col-md-6 col-lg-3">
                                                            <div class="form-group">
                                                                <label for="service_type">Type: <span class="text-danger">*</span></label>
                                                                <select name="service_type" id="service_type" type="text" class="form-control select" required></select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6 col-md-6 col-lg-3">
                                                            <div class="form-group">
                                                                <label for="service_amount">Amount: <span class="text-danger">*</span></label>
                                                                <select name="service_amount" id="service_amount" type="text" class="form-control select" readonly="" required></select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6 col-md-6 col-lg-3">
                                                            <div class="form-group">
                                                                <label for="payment_type">Payment Type</label>
                                                                <select name="payment_type" id="payment_type" class="form-control select">
                                                                    @foreach(get_payment_type() as $payment_type)
                                                                        <option>{{ $payment_type->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6 col-md-6 col-lg-3">
                                                            <div class="form-group">
                                                                <label for="payment_status">Payment Status</label>
                                                                <select name="payment_status" id="payment_status" class="form-control select">
                                                                    @foreach(get_payment_status() as $payment_status)
                                                                        <option>{{ $payment_status->status }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="m-t-20 text-center">
                                                <button class="btn btn-primary submit-btn" type="submit">Add Procedure</button>
                                                <a href="{{route('admin.patient.show', $patient->id)}}" class="btn btn-danger submit-btn">Cancel</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection


@section('page-script')
    <script>
        $(document).ready(function(){
            $("#service").change(function(){
                let service = $("#service").val();
                $.ajax({
                    url: "{{ route('admin.ajax.service_type') }}",
                    type: "POST",
                    data: { service_id: service },
                    beforeSend: function(){ $("#service_type").html(""); $("#service_type").html("") },
                    success: function(response) { $("#service_type").html(response) },
                    error: function (xhr, status, error) {
                        alert(xhr.responseText);
                    }
                })
            });

            $("#service_type").change(function(){
                let type = $("#service_type").val();
                $.ajax({
                    url: "{{ route('admin.ajax.service_amount') }}",
                    type: "POST",
                    data: { type_id: type },
                    beforeSend: function(){ $("#service_amount").html("") },
                    success: function(response) { $("#service_amount").html(response) },
                    error: function (xhr, status, error) {
                        alert(xhr.responseText);
                    }
                })
            })
        });
    </script>
@endsection
