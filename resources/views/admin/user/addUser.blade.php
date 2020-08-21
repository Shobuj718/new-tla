@extends('admin.app')

@section('title', 'User Add')

@section('content')

<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-home" aria-hidden="true"></i><a href="#">Manage Users</a></li>
            <li><i aria-hidden="true"></i><a href="#">User List </a></li>
            <li><i aria-hidden="true"></i><a href="#">Add User </a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInUp">
    <div class="col-sm-12 col-md-8 col-md-offset-2">
        <div class="panel b-primary bt-md">
            <div class="panel-content">
                <div class="row">
                    <div class="col-md-12">
                        <form class="form-horizontal" action="{{ route('users.store') }}" method="POST">
                            @csrf
                            <h3 class="mb-lg"><b> ADD USER</b>
                            <a href="{{ route('users.view') }}" title="" class="btn btn-primary btn-sm" style="float: right"><i class="fa fa-list" aria-hidden="true"></i> User List</a>
                            </h3>
                            <div class="form-group">
                                <label for="userType" class="col-sm-2 control-label">User Type</label>
                                <div class="col-sm-9">
                                    <select type="text" name="userType" class="form-control"  >
                                            <option value>Admin</option>
                                            <option value>SubAdmin</option>

                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Name</label>
                                <div class="col-sm-9">
                                    <input type="name" name="name" class="form-control" id="name" placeholder="Enter  Your Name">
                                </div>
                            </div>
                             <div class="form-group">
                                <label for="email2" class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" name="email" class="form-control" id="email2" placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password2" class="col-sm-2 control-label">Password</label>
                                <div class="col-sm-9">
                                    <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password_confirm" class="col-sm-2 control-label">Password</label>
                                <div class="col-sm-9">
                                    <input type="password_confirm" name="password_confirm" class="form-control"  placeholder="Password_confirm">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-9">
                                    <button type="submit" class="btn btn-primary">SAVE</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
