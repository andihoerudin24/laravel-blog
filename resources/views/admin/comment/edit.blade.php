@extends('layouts.admin.app')
@section('content')

<div class="container-fluid">
        <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Comment</a>
                </li>
               <li class="breadcrumb-item active"> Edit</li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-white bg-primary">
                    Edit Comment
                </div>
                {!! Form::model($comments,['route'=>['admin.comment.update',$comments->id],'method'=>'put']) !!}
         <div class="card-body">

                <div class="form-group">
                      <label for="name">Full name</label>
                      <input type="text" name="name" readonly value="{{$comments->name}}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" value="{{$comments->email}}" readonly class="form-control">
                </div>

                <div class="form-group">
                        <label for="comments">Comment</label>
                        <textarea name="body" readonly class="form-control" cols="30" rows="10">{{ $comments->body }}</textarea>
                </div>

                <div class="form-group">
                        <label for="status">Status</label>
                        {!! Form::select('status',[0=>'Hide',1=>'Publish'],null,['class'=>'form-control','required']) !!}
                </div>

                <div class="card-footer bg-transparent">
                     <button type="submit" class="btn btn-primary">Submit</button>
                </div>



          </div>
                {!! Form::close() !!}
          </div>
        </div>
    </div>
</div>

@endsection