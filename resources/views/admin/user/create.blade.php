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
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <h4 class="page-title">Add User</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="name">Name: <span class="text-danger">*</span></label>
                            <input name="name" id="name" class="form-control" type="text" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="username">Username: <span class="text-danger">*</span></label>
                            <input name="username" id="username" class="form-control" type="text" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="password">Password: <span class="text-danger">*</span></label>
                            <input name="password" id="password" class="form-control" type="text" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="dob">Date of Birth </label>
                            <input name="dob" id="dob" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group gender-select">
                            <label class="gen-label">Gender:  <span class="text-danger">*</span></label>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input name="gender" type="radio" class="form-check-input" value="Male" required>Male
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input name="gender" type="radio" class="form-check-input" value="Female" required>Female
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="phone">Phone: <span class="text-danger">*</span></label>
                            <input name="phone" id="phone" class="form-control" type="text" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="email">Email: </label>
                            <input name="email" id="email" class="form-control" type="text">
                        </div>
                    </div>
                    {{--<div class="col-sm-4">
                        <div class="form-group">
                            <label for="account_number">Account Number:  <span class="text-danger">*</span></label>
                            <input name="account_number" id="account_number" type="text" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="account_name">Account Name: <span class="text-danger">*</span></label>
                            <input name="account_name" id="account_name" class="form-control" type="text" required>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="bank_name">Bank Name: <span class="text-danger">*</span></label>
                            <input name="bank_name" id="bank_name" class="form-control" type="text" required>
                        </div>
                    </div>--}}

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="role">Role: <span class="text-danger">*</span></label>
                            <select name="role" id="role" class="form-control select" type="text" required>
                                <option></option>
                                @foreach(get_roles() as $role)
                                    <option>{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="m-t-20 text-center">
                    <button class="btn btn-primary submit-btn" type="submit">Create User</button>
                </div>
            </form>
        </div>
    </div>
@endsection


@section('page-script')
    <script>

    </script>
@endsection
