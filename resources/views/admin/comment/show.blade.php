@extends('layouts.admin.app')

@section('content')
    <div class="container-fluid">
         <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#">Comment</a>
                    </li>
                   <li class="breadcrumb-item active">Comment Detail</li>
        </ol>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-white bg-primary">
                       Comment Detail : {{$comments->post->title}}
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                   <tr>
                            <td>ID</td>
                            <td>{{$comments->id}}</td>
                   </tr>
                   <tr>
                                <td>Name</td>
                                <td>{{$comments->name}}</td>
                   </tr>
                   <tr>
                            <td>Email</td>
                            <td>{{$comments->email}}</td>
                    </tr>
                    <tr>
                                <td>Comment</td>
                                <td>{{$comments->body}}</td>
                    </tr>
                    <tr>
                            <td>Time</td>
                            <td>{{$comments->created_at}}</td>
                    </tr>
                    <tr>
                            <td>Status</td>
                            <td>{{$comments->status ==1 ? 'Publish' : 'Hide' }}</td>
                        </tr>
                </table>
                    </div>
                </div>
            </div>
        </div>
 </div>
@endsection