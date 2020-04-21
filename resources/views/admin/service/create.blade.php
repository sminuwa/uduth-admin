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
            <h4 class="page-title">Add Procedures</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <form action="{{ route('admin.service.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">

                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="service">Procedure <span class="text-danger">*</span></label>
                                    <input name="service" id="service" type="text" class="form-control select" required>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="service_amount">Type: <span class="text-danger">*</span></label>
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
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="referral_letter">Referral Letter</label>
                                    <input name="referral_letter" id="referral_letter" type="file" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="m-t-20 text-center">
                    <button class="btn btn-primary submit-btn" type="submit">Create Patient</button>
                </div>
            </form>
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
