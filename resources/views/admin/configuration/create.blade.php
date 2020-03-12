@extends('admin.app')

@section('sidebar-configuration', 'active')

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
            <h4 class="page-title">Add Configuration (#{{$identifier}})</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <div style="height:15px;"></div>
            <form name="config-form" id="config-form" method="post" action="{{ route('admin.configuration.store') }}">
                @csrf
                <div id="config-panel">
                    <div class="form-row">
                        <div class="form-group col-md-7">
                            <label for="patient-name">Name</label>
                            <input type="text" class="form-control" name="1name" required id="1name">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="patient-name">Value</label>
                            <input type="text" class="form-control" name="1value" required id="1value">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="patient-name">Type</label>
                            <select type="text" class="form-control" name="1type" required id="1type">
                                <option>Fixed</option>
                                <option>Fixed%</option>
                                <option>#1</option>
                                <option>#2</option>
                                <option>#3</option>
                                <option>#4</option>
                                <option>#5</option>
                            </select>
                        </div>
                        <div class="form-group col-md-1">
                        </div>
                    </div>
                </div>
                <div id="general-notification"></div>
                <div class="form-row">
                    <div class="form-group col-md-11">
                        <a href="javascript:;" id="add-config-btn" class="btn btn-warning btn-sm float-right"><i
                                class="ti-plus"></i>
                            Add field
                        </a>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-primary" id="submit-btn">Save Configs</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection


@section('page-script')
    <script>
        // $form = $("<form></form>");
        let formName = 1;
        $(document).ready(function () {
            $("#add-config-btn").click(function () {
                formName = formName + 1;
                $("#config-panel").append('' +
                    '<div class="form-row" id="' + formName + 'row">' +
                    '<div class="form-group col-md-7">' +
                    '<input type="text" class="form-control" name="' + formName + 'name" id="' + formName + 'name" required>' +
                    '</div>' +
                    '<div class="form-group col-md-2">' +
                    '<input type="text" class="form-control" name="' + formName + 'value" id="' + formName + 'value" required>' +
                    '</div>' +
                    '<div class="form-group col-md-2">' +
                    '<select type="text" class="form-control" name="' + formName + 'type" id="' + formName + 'type" required>' +
                    '<option>Fixed</option>' +
                    '<option>Fixed%</option>' +
                    '<option>#1</option>' +
                    '<option>#2</option>' +
                    '<option>#3</option>' +
                    '<option>#4</option>' +
                    '<option>#5</option>' +
                    '</select>' +
                    '</div>' +
                    '<div class="form-group col-md-1"> ' +
                    '<a style="color:#fff;" class="btn btn-danger btn-sm" id="' + formName + 'close-btn"><i class="fa fa-close"></i></a> ' +
                    '</div>' +
                    '</div>' +
                    '');
                // $("#config-form").html(form + "Hello")
                close_btn(formName)
            });

            function close_btn(num) {
                $("#" + num + "close-btn").click(function () {
                    $("#" + num + "row").remove()
                    formName = formName - 1;
                });
                return num;
            }

            $("#config-form").on("submit", function (e) {
                e.preventDefault();

                // ;
                //disabling all the existing configuration
                $.ajax({
                    url: "{{ route('admin.configuration.disable') }}",
                    type: "POST",
                    data: {action: "true"},
                    success: function () {
                        for (let i = 1; i <= formName; i++) {
                            // if (check_per1 === 100) {
                            $.ajax({
                                url: "{{ route('admin.configuration.store') }}",
                                type: "POST",
                                data: {
                                    name: $("#" + i + "name").val(),
                                    value: $("#" + i + "value").val(),
                                    type: $("#" + i + "type").val(),
                                    status: 1,
                                    identifier: "Configuration {{$identifier}}"
                                },
                                success: function (result) {
                                    $("#general-notification").html("<h6 style='color:#008844;'>Configuration has been saved successfully</h6>");
                                    setInterval(function(){ location = "{{ route('admin.configuration.create') }}"; }, 1000)
                                },
                                error: function (error) {
                                    // alert(error);
                                    alert("error has occurred");
                                }
                            });
                            // }

                        }
                    }

                });

            });
        });
    </script>
@endsection
