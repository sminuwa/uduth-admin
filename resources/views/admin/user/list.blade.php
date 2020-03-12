@extends('admin.app')

@section('sidebar-user', 'active')

@section('page-title')
    <div class="row">
        <div class="col-sm-4 col-3">
            <h4 class="page-title">
                Users
            </h4>
        </div>
        <div class="col-sm-8 col-9 text-right m-b-20">
            <a href="{{ route('admin.user.create') }}" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-user-plus"></i> New User</a>
        </div>
    </div>
@endsection

@section('page-content')



    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-border table-striped custom-table datatable mb-0">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th class="text-right">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach(get_users()->where('users.id', '!=', get_user()->id)->get() as $user)
                        <tr>
                            <td>
                                <img width="28" height="28" src="{{ asset('assets/img/user.jpg') }}" class="rounded-circle m-r-5" alt="">
                                {{ $user->name }}
                            </td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ ucfirst($user->role) }}</td>
                            <td>{{ ucfirst($user->status) }}</td>
                            <td class="text-right">
                                <a  href="{{ route('admin.user.show', $user->id) }}" class="btn btn-outline-primary btn-sm">
                                    <i class="fa fa-user m-r-5"></i> Profile
                                </a>
                                @if($user->id != get_user()->id)
                                    @if($user->status == 'active')
                                        <a  href="{{ route('admin.user.suspend', $user->id) }}" class="btn btn-outline-warning btn-sm">
                                            <i class="fa fa-user m-r-5"></i> Suspend
                                        </a>
                                        @else
                                        <a  href="{{ route('admin.user.activate', $user->id) }}" class="btn btn-outline-dark btn-sm">
                                            <i class="fa fa-user m-r-5"></i> Activate
                                        </a>
                                    @endif
                                @endif
                            </td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection


