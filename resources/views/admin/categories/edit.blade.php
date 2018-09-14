@extends('layouts.admin.app')
@section('content')
<div class="container-fluid">
        <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Categories</a>
                </li>
                <li class="breadcrumb-item active">Update</li>
            </ol>
  <div class="row">
      <div class="col-md-12">
               <div class="card">
                  <div class="card-header text-white bg-primary">
                    Add New Categories
                  </div>
                 {!! Form::model($edit,['route'=>['admin.categories.update',$edit->id],'method'=>'PUT']) !!}
                  @include('admin.categories._form')
                {!! Form::close() !!}
        </div>
      </div>
  </div>
</div>
@endsection

