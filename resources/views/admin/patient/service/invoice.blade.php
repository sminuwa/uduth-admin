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
        <div class="col-sm-5 col-4">
            <h4>Payment Invoice</h4>
        </div>
        <div class="col-sm-7 col-8 text-right m-b-30">
            <div class="btn-group btn-group-sm">
                <button onclick="history.back();" class="btn btn-outline-primary"><i class="fa fa-print fa-lg"></i> Back</button>
                <button onclick="print();" class="btn btn-white"><i class="fa fa-print fa-lg"></i> Print</button>
            </div>
        </div>
    </div>
    <div class="row" id="section-to-print">
        <div class="col-md-12">
            <br>
            <div class="card-box" style="margin-bottom: 0px;">
                <h4 class="payslip-title"></h4>
                <div class="row">
                    <div class="col-sm-6 m-b-20">
                        <div class="row">
                            <div class="col-md-3 text-right">

                                <img src="{{ asset('assets/img/uduth-logo.png') }}" class="inv-logo" alt="" width="100%">
                            </div>
                            <div class="col-md-9" style="left: 10px;">
                                <ul class="list-unstyled mb-0">
                                    <li>Usmanu Danfodiyo University Teaching Hospital, Sokoto</li>
                                    <li>P.M.B. 2370</li>
                                    <li>Sokoto</li>
                                    <li>Nigeria</li>
                                </ul>
                            </div>
                        </div>


                    </div>
                    {{--                    <img src="{{ app_path('Barcode.php') }}?text={{ $payment->receipt_no }}" height="50"/>--}}
                    {{--                    {{ $payment->id }}--}}
                    {{--                    {{ app_path('Helpers/lib.barcode.php') }}--}}
                    <div class="col-sm-6 m-b-20">
                        <div class="invoice-details">
                            <h3 class="text-uppercase">[Receipt Info]</h3>
                            <ul class="list-unstyled">
                                <li>
                                    <?php
                                    $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                                    echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode(get_receipt_no($payment->receipt_no), $generator::TYPE_CODE_128)) . '">';
                                    ?>
                                </li>
                                <li>Invoice No: <span>{{ get_receipt_no($payment->receipt_no) }}</span></li>
                                <li>Patient ID: <span>{{ $patient->uid }}</span></li>
                                <li>Date: <span>{{ $payment->created_at }}</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-6">
                        <div>
                            {{--                            <h4 class="m-b-10"><strong>Earnings</strong></h4>--}}
                            <table class="table table-bordered table-striped">
                                <tbody>
                                <tr>
                                    <th style="padding: .25rem;">Name </th>
                                    <td style="padding: .25rem;">{{ $patient->name }}</td>
                                </tr>
                                <tr>
                                    <th style="padding: .25rem;">Gender </th>
                                    <td style="padding: .25rem;">{{ $patient->gender }}</td>
                                </tr>
                                <tr>
                                    <th style="padding: .25rem;">Phone Number </th>
                                    <td style="padding: .25rem;">{{ $patient->phone }}</td>
                                </tr>
                                <tr>
                                    <th style="padding: .25rem;">Address </th>
                                    <td style="padding: .25rem;">{{ $patient->address }}</td>
                                </tr>
                                <tr>
                                    <th style="padding: .25rem;">Patient Type </th>
                                    <td style="padding: .25rem;">{{ $patient->patient_type }}</td>
                                </tr>
                                <tr>
                                    <th style="padding: .25rem;">File No </th>
                                    <td style="padding: .25rem;">{{ $patient->file_no }}</td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div>
                            {{--                            <h4 class="m-b-10"><strong>Deductions</strong></h4>--}}
                            <table class="table table-bordered table-striped">
                                <tbody>
                                <tr>
                                    <th style="padding: .25rem;"><strong>Procedure</strong> </th>
                                    <td style="padding: .25rem;">
                                        {{ get_payment($payment->id)->service_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="padding: .25rem;"><strong>Type</strong> </th>
                                    <td style="padding: .25rem;">
                                        {{ get_payment($payment->id)->service_type_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="padding: .25rem;"><strong>Amount</strong> </th>
                                    <td style="padding: .25rem;">
                                        {{ $payment->service_amount }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="padding: .25rem;"><strong>Payment Type</strong> </th>
                                    <td style="padding: .25rem;">
                                        {{ $payment->payment_type }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="padding: .25rem;"><strong>Payment Status</strong> </th>
                                    <td style="padding: .25rem;">
                                        {{ $payment->payment_status }}
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <p><strong>Generated by</strong> {{ get_user()->name }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <br>
            <div class="card-box"  style="margin-bottom: 0px;">
                <h4 class="payslip-title"></h4>
                <div class="row">
                    <div class="col-sm-6 m-b-20">
                        <div class="row">
                            <div class="col-md-3 text-right">

                                <img src="{{ asset('assets/img/uduth-logo.png') }}" class="inv-logo" alt="" width="100%">
                            </div>
                            <div class="col-md-9" style="left: 10px;">
                                <ul class="list-unstyled mb-0">
                                    <li>Usmanu Danfodiyo University Teaching Hospital, Sokoto</li>
                                    <li>P.M.B. 2370</li>
                                    <li>Sokoto</li>
                                    <li>Nigeria</li>
                                </ul>
                            </div>
                        </div>


                    </div>
                    {{--                    <img src="{{ app_path('Barcode.php') }}?text={{ $payment->receipt_no }}" height="50"/>--}}
                    {{--                    {{ $payment->id }}--}}
                    {{--                    {{ app_path('Helpers/lib.barcode.php') }}--}}
                    <div class="col-sm-6 m-b-20">
                        <div class="invoice-details">
                            <h3 class="text-uppercase">[Receipt Info]</h3>
                            <ul class="list-unstyled">
                                <li>
                                    <?php
                                    $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                                    echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode(get_receipt_no($payment->receipt_no), $generator::TYPE_CODE_128)) . '">';
                                    ?>
                                </li>
                                <li>Invoice No: <span>{{ get_receipt_no($payment->receipt_no) }}</span></li>
                                <li>Patient ID: <span>{{ $patient->uid }}</span></li>
                                <li>Date: <span>{{ $payment->created_at }}</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-6">
                        <div>
                            {{--                            <h4 class="m-b-10"><strong>Earnings</strong></h4>--}}
                            <table class="table table-bordered table-striped">
                                <tbody>
                                <tr>
                                    <th style="padding: .25rem;">Name </th>
                                    <td style="padding: .25rem;">{{ $patient->name }}</td>
                                </tr>
                                <tr>
                                    <th style="padding: .25rem;">Gender </th>
                                    <td style="padding: .25rem;">{{ $patient->gender }}</td>
                                </tr>
                                <tr>
                                    <th style="padding: .25rem;">Phone Number </th>
                                    <td style="padding: .25rem;">{{ $patient->phone }}</td>
                                </tr>
                                <tr>
                                    <th style="padding: .25rem;">Address </th>
                                    <td style="padding: .25rem;">{{ $patient->address }}</td>
                                </tr>
                                <tr>
                                    <th style="padding: .25rem;">Patient Type </th>
                                    <td style="padding: .25rem;">{{ $patient->patient_type }}</td>
                                </tr>
                                <tr>
                                    <th style="padding: .25rem;">File No </th>
                                    <td style="padding: .25rem;">{{ $patient->file_no }}</td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div>
                            {{--                            <h4 class="m-b-10"><strong>Deductions</strong></h4>--}}
                            <table class="table table-bordered table-striped">
                                <tbody>
                                <tr>
                                    <th style="padding: .25rem;"><strong>Procedure</strong> </th>
                                    <td style="padding: .25rem;">
                                        {{ get_payment($payment->id)->service_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="padding: .25rem;"><strong>Type</strong> </th>
                                    <td style="padding: .25rem;">
                                        {{ get_payment($payment->id)->service_type_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="padding: .25rem;"><strong>Amount</strong> </th>
                                    <td style="padding: .25rem;">
                                        {{ $payment->service_amount }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="padding: .25rem;"><strong>Payment Type</strong> </th>
                                    <td style="padding: .25rem;">
                                        {{ $payment->payment_type }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="padding: .25rem;"><strong>Payment Status</strong> </th>
                                    <td style="padding: .25rem;">
                                        {{ $payment->payment_status }}
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <p><strong>Generated by</strong> {{ get_user()->name }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <br>
            <div class="card-box"  style="margin-bottom: 0px;">
                <h4 class="payslip-title"></h4>
                <div class="row">
                    <div class="col-sm-6 m-b-20">
                        <div class="row">
                            <div class="col-md-3 text-right">

                                <img src="{{ asset('assets/img/uduth-logo.png') }}" class="inv-logo" alt="" width="100%">
                            </div>
                            <div class="col-md-9" style="left: 10px;">
                                <ul class="list-unstyled mb-0">
                                    <li>Usmanu Danfodiyo University Teaching Hospital, Sokoto</li>
                                    <li>P.M.B. 2370</li>
                                    <li>Sokoto</li>
                                    <li>Nigeria</li>
                                </ul>
                            </div>
                        </div>


                    </div>
                    {{--                    <img src="{{ app_path('Barcode.php') }}?text={{ $payment->receipt_no }}" height="50"/>--}}
                    {{--                    {{ $payment->id }}--}}
                    {{--                    {{ app_path('Helpers/lib.barcode.php') }}--}}
                    <div class="col-sm-6 m-b-20">
                        <div class="invoice-details">
                            <h3 class="text-uppercase">[Receipt Info]</h3>
                            <ul class="list-unstyled">
                                <li>
                                    <?php
                                    $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                                    echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode(get_receipt_no($payment->receipt_no), $generator::TYPE_CODE_128)) . '">';
                                    ?>
                                </li>
                                <li>Invoice No: <span>{{ get_receipt_no($payment->receipt_no) }}</span></li>
                                <li>Patient ID: <span>{{ $patient->uid }}</span></li>
                                <li>Date: <span>{{ $payment->created_at }}</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-6">
                        <div>
                            {{--                            <h4 class="m-b-10"><strong>Earnings</strong></h4>--}}
                            <table class="table table-bordered table-striped">
                                <tbody>
                                <tr>
                                    <th style="padding: .25rem;">Name </th>
                                    <td style="padding: .25rem;">{{ $patient->name }}</td>
                                </tr>
                                <tr>
                                    <th style="padding: .25rem;">Gender </th>
                                    <td style="padding: .25rem;">{{ $patient->gender }}</td>
                                </tr>
                                <tr>
                                    <th style="padding: .25rem;">Phone Number </th>
                                    <td style="padding: .25rem;">{{ $patient->phone }}</td>
                                </tr>
                                <tr>
                                    <th style="padding: .25rem;">Address </th>
                                    <td style="padding: .25rem;">{{ $patient->address }}</td>
                                </tr>
                                <tr>
                                    <th style="padding: .25rem;">Patient Type </th>
                                    <td style="padding: .25rem;">{{ $patient->patient_type }}</td>
                                </tr>
                                <tr>
                                    <th style="padding: .25rem;">File No </th>
                                    <td style="padding: .25rem;">{{ $patient->file_no }}</td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div>
                            {{--                            <h4 class="m-b-10"><strong>Deductions</strong></h4>--}}
                            <table class="table table-bordered table-striped">
                                <tbody>
                                <tr>
                                    <th style="padding: .25rem;"><strong>Procedure</strong> </th>
                                    <td style="padding: .25rem;">
                                        {{ get_payment($payment->id)->service_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="padding: .25rem;"><strong>Type</strong> </th>
                                    <td style="padding: .25rem;">
                                        {{ get_payment($payment->id)->service_type_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="padding: .25rem;"><strong>Amount</strong> </th>
                                    <td style="padding: .25rem;">
                                        {{ $payment->service_amount }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="padding: .25rem;"><strong>Payment Type</strong> </th>
                                    <td style="padding: .25rem;">
                                        {{ $payment->payment_type }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="padding: .25rem;"><strong>Payment Status</strong> </th>
                                    <td style="padding: .25rem;">
                                        {{ $payment->payment_status }}
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <p><strong>Generated by</strong> {{ get_user()->name }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('page-script')

@endsection
