@extends('admin.app')

@section('sidebar-report', 'active')

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
            <h4 class="page-title">Send Report</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <form action="{{ route('admin.report.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Last Name:  <span class="text-danger">*</span></label></label>
                    <div class="col-md-10">
                        <input name="sender"  type="text" class="form-control" value="{{ get_user()->name  }}" readonly required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Subject:  <span class="text-danger">*</span></label></label>
                    <div class="col-md-10">
                        <input name="subject"  type="text" class="form-control" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Description:  <span class="text-danger">*</span></label></label>
                    <div class="col-md-10">
                        <textarea name="description"  type="text" rows="7" class="form-control" required></textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-2 col-form-label"></label>
                    <div class="col-md-10">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="send_mail" id="send_mail" checked>
                            <label class="form-check-label" for="gender_male">
                                Send a report to email addresses
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-2 col-form-label"></label>
                    <div class="col-md-10">
                        <button class="btn btn-primary submit-btn" type="submit">Send a report</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection


@section('page-script')

@endsection
