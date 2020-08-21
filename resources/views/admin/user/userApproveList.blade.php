
@extends('admin.app')

@section('title', 'User Approve List')

@section('content')

<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-home" aria-hidden="true"></i><a href="#">Manage User</a></li>
            <li><i aria-hidden="true"></i><a href="#">User Approve List</a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInRight">
    <div class="col-sm-12">
        <div class="panel b-primary bt-md">
            <div class="panel-content">
            	<h4 class="section-subtitle"><b>User Approve List</b>
            
            	</h4>
            	<hr>
                <div class="table-responsive">
                    <table id='userTable' class="data-table table-bordered table table-striped nowrap table-hover" width='100%' border="1" style='border-collapse: collapse;'>
                        <thead>
                            <tr>
                                <!--<td>Package UID</td>-->
                                <td>SL</td>
                                <td>Name</td>
                                <td>User Name</td>
                                 <td>Phone</td>
                                <td>Email</td>
                                 <td>Location</td>
                                <td>Option</td>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){

        // DataTable
        $('#userTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{route('users.getUserApproveList')}}",
            columns: [
                { data: 'id' },
                { data: 'name' },
                { data: 'username' },
                { data: 'phone' },
                { data: 'email' },
                 { data: 'location' },
                { data: 'options' }
                
            ],
            "pageLength": 10
        });
        

    });
</script>
@endsection