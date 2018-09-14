@extends('layouts.admin.app')

@section('asset-top')
<link href="{{ asset('assets/blog-admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/blog-admin/vendor/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

   <div class="container-fluid">
       <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Comment</a>
            </li>
            <li class="breadcrumb-item active">Table</li>
        </ol>

      <div class="card mb-3">
          <div class="card-header">
             <i class="fa fa-list"></i>Comment
          </div>
          <div class="card-body table-responsive">
                <div class="table-responsive">
                     <table class="table table-bordered" id="dataTable" width="100%" collsapacing="0">
               <thead>
                   <tr>
                       <th>No</th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Comment</th>
                        <th>Post</th>
                        <th>Status</th>
                        <th></th>
                   </tr>
               </thead>
               <tfoot>
                    <tr>
                            <th>No</th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Comment</th>
                            <th>Post</th>
                            <th>Status</th>
                            <th></th>
                       </tr>
                 </tfoot>
               <tbody></tbody>
             </table>
            </div>
          </div>
      </div>
   </div>
@endsection
@section('assets-bottom')
<script src="{{ asset('assets/blog-admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/blog-admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/blog-admin/vendor/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/blog-admin/vendor/datatables/responsive.bootstrap4.min.js') }}"></script>
<script>
    $(document).ready(function(){
        $("#dataTable").DataTable({
            processing:true,
            serverside:true,
            ajax:"{{ route('api.datatable.comment') }}",
            columns:[
                {data: 'DT_Row_Index',orderable: false, searchable: false},

                {data:'id',         name:'id'},
                {data:'name',       name:'name'},
                {data:'comment',    name:'comment'},
                {data:'post',         name:'post'},
                {data:'status',         name:'status'},
                {data:'action',         name:'action'},
            ]
        })
    })
</script>
@endsection