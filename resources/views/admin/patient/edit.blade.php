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
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <h4 class="page-title">Update Patient Record</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <form action="{{ route('admin.patient.update', $patient->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                {{method_field("PUT")}}
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="name">Name: <span class="text-danger">*</span></label>
                            <input name="name" id="name" class="form-control" type="text" value="{{$patient->name}}" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="age">Age: <span class="text-danger">*</span></label>
                            <input name="age" id="age" class="form-control" type="text" value="{{$patient->age}}" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="patient_type">Type of Patient: <span class="text-danger">*</span></label>
                            <select name="patient_type" id="patient_type" class="form-control select" type="text" required>
                                <option>{{$patient->patient_type}}</option>
                                <option>Local</option>
                                <option>Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="file_no">File No (If Local): </label>
                            <input name="file_no" id="file_no" type="text" class="form-control" value="{{$patient->file_no}}">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group gender-select">
                            <label class="gen-label">Gender:  <span class="text-danger">*</span></label>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input name="gender" type="radio" class="form-check-input" @if($patient->gender == "Male") checked @endif value="Male" required>Male
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input name="gender" type="radio" class="form-check-input" @if($patient->gender == "Female") checked @endif value="Female" required>Female
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="phone">Phone: <span class="text-danger">*</span></label>
                            <input name="phone" id="phone" class="form-control" type="text" value="{{$patient->phone}}" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="email">Email: </label>
                            <input name="email" id="email" class="form-control" type="text" value="{{$patient->email}}">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="companion">Name of Companion:  <span class="text-danger">*</span></label>
                            <input name="companion" id="companion" type="text" class="form-control" value="{{$patient->companion}}" required>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="address">Address: <span class="text-danger">*</span></label>
                            <textarea name="address" id="address" class="form-control" type="text" required>{{$patient->address}}</textarea>
                        </div>
                    </div>

                </div>

                <div class="m-t-20 text-center">
                    <button class="btn btn-primary submit-btn" type="submit">Update</button>
                    <a href="{{route('admin.patient.show', $patient->id)}}" class="btn btn-danger submit-btn">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection


@section('page-script')

@endsection
