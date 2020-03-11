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
                                    <div >
                                        <?php
                                        $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                                        echo '<img width="60%" src="data:image/png;base64,' . base64_encode($generator->getBarcode(get_receipt_no($patient->uid), $generator::TYPE_CODE_128)) . '">';
                                        ?>
                                    </div>
                                    <br>
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
                            <div class="text-right m-b-20">
                                <a href="{{ route('admin.patient.add.service', $patient->id) }}" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Procedure</a>
                            </div>
                            <h3 class="card-title">Invoices</h3>
                            <div class="experience-box">
                                <table class="table table-border table-striped custom-table datatable mb-0">
                                    <thead>
                                        <tr>
                                            <th>Procedures</th>
                                            <th>Type</th>
                                            <th>Amount</th>
                                            <th>Payment Type</th>
                                            <th>Payment Status</th>
                                            <th>Date</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach(get_payments($patient->id) as $payment)
                                            <tr>
                                                <td>{{ $payment->service_name }}</td>
                                                <td>{{ $payment->service_type_name }}</td>
                                                <td>{{ $payment->service_amount }}</td>
                                                <td>{{ $payment->payment_type }}</td>
                                                <td>{{ $payment->payment_status }}</td>
                                                <td>{{ $payment->created_at }}</td>
                                                <td class="text-right">
                                                    <a href="{{ route('admin.patient.payment.invoice', ['patient'=>$patient->id, 'payment'=>$payment->id]) }}" class="btn btn-outline-primary btn-sm"><i class="fa fa-print"></i> Print Invoice</a>
                                                </td>
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
