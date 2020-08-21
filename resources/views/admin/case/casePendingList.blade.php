@extends('admin.app')

@section('title', 'Case Pending List')

@section('content')

<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-home" aria-hidden="true"></i><a href="#">Casses</a></li>
            <li><i aria-hidden="true"></i><a href="#">Case Pending List</a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInRight">
    <div class="col-sm-12">
        <div class="panel b-primary bt-md">
            <div class="panel-content">
            	<h4 class="section-subtitle"><b>Case List</b>
				<a href="{{ route('case.add') }}" pageName="Add New Case" data-remote="false" data-toggle="modal"  data-target="#myModal" class="btn btn-sm btn-primary waves-effect md-trigger" style="float: right;"> Add New </a>
            	</h4>
            	<hr>
                <div class="table-responsive">
                    <table id='empTable' class="data-table table-bordered table table-striped nowrap table-hover" width='100%' border="1" style='border-collapse: collapse;'>
                        <thead>
                            <tr>
                                <th>SL.</th>
                                <th>Case Title</th>
                                <th>Budget</th>
                                <th>Description</th>
                                <th>Category Id</th>
                                <th>Location </th>
                                <th>Post Code</th>
                                <th>Action</th>
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
        $('#empTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{route('casse.getCasePendingList')}}",
            columns: [
                { data: 'id' },
                { data: 'title' },
                { data: 'budget' },
                { data: 'description' },
                { data: 'category_id' },
                { data: 'location_name' },
                { data: 'post_code' },
                { data: 'options' },
                
            ],
            "pageLength": 10
        });
        

    });
</script>

@endsection
