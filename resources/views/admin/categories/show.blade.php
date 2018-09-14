@extends('layouts.admin.app')
@section('content')
<div class="container-fluid">
        <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Categories</a>
                </li>
                <li class="breadcrumb-item active">Show Categories</li>
            </ol>
  <div class="row">
      <div class="col-md-12">
               <div class="card">
                  <div class="card-header text-white bg-primary">
                    Categories Detail: {{ $show->title }}
                  </div>
                  <div class="card-body">
                      <table class="table table-striped">
                           <tr>
                               <th>ID</th>
                               <th>{{ $show->id }}</th>
                           </tr>
                           <tr>
                               <th>Slug</th>
                               <th>{{$show->slug}}</th>
                           </tr>
                           <tr>
                               <th>Title</th>
                               <th>{{ $show->title }}</th>
                           </tr>
                      </table>
                  </div>

          </div>
      </div>
  </div>
</div>
@endsection