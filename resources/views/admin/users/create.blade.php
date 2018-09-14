@extends('layouts.admin.app')
@section('content')
    <div class="container-fluid">
     <ol class="breadcrumb">
         <li class="breadcrumb-item">
             <a href="#">User</a>
         </li>
         <li class="breadcrumb-item active">
            add new
         </li>
     </ol>
     <div class="row">
         <div class="col-md-12">
             <div class="card">
                 <div class="card-header text-white bg-primary">
                     add new users
                 </div>
                 {!! Form::open(['route'=>'admin.users.store','method'=>'POST']) !!}
                    @include('admin.users._form')
                {!! Form::close() !!}

             </div>
         </div>
     </div>
</div>
@endsection