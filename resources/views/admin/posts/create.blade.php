@extends('layouts.admin.app')
@section('content')
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Posts</a>
            </li>
            <li class="breadcrumb-item active">Add New</li>
        </ol>
        {!! Form::open(['route' => 'admin.posts.store', 'method' => 'POST']) !!}
            @include('admin.posts._form')
        {!! Form::close() !!}
    </div>
@endsection

