@extends('admin.app')

@section('sidebar-revenue', 'active')

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
            <h4>Revenue Invoice</h4>
        </div>
        <div class="col-sm-7 col-8 text-right m-b-30">
            <div class="btn-group btn-group-sm">
                <button onclick="history.back();" class="btn btn-outline-primary"><i class="fa fa-print fa-lg"></i> Back</button>
                <button onclick="print();" class="btn btn-white"><i class="fa fa-print fa-lg"></i> Print</button>
            </div>
        </div>
    </div>
    <div class="row" >

        <div class="col-md-8 offset-md-2" style="">
            <div class="card-box">
                <h4 class="payslip-title"></h4>
                <div class="row">
                    <div class="col-sm-12 m-b-20" id="section-to-print">
                        <h3>Revenue report</h3>
                        <p>This is report has been automatically generated based on the formula that was configured last</p>
                        <br>
                        <?php echo calculateRevenue($date); ?>
                        <br>
                        <br>
                        <p class="color-red"><strong>NOTE:</strong> You can only get access to this report unless you save it.
                            To do that, kindly click on the "Print" button at the top-right corner of the report page
                        </p>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection


@section('page-script')

@endsection
