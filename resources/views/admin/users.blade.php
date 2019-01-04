@extends('layouts.blog_tpl')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <!-- <div class="col-md-12"> -->
            <div class="card">
                <div class="card-header">
                    @if (session('status'))
                        
                        <div class="alert alert-success alert-dismissible fade show" 
                        role="alert">
                            {{ session('status') }}
                            <button type="button" 
                            class="close" 
                            data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                    @endif
                    <div class="d-flex">
                        <h5 class="p-2">All Users</h5>
                        <a href="{{ route('users.create')}}" 
                        class="btn btn-primary btn-sm ml-auto p-2">Create User</a>
                    </div>
                </div>

                <div class="card-body">
                    

                    @if($users->count())
                        <table class="table table-bordered">
                        <thead>
                        <tr>
                        <th>ID</th>
                        <th>Fullname</th>
                        <th>Deleted</th>

                       
                       
                        <th>Actions</th></tr>

                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                            
                                <td><a href="{{ route('users.show',$user->id)}}">{{$user->firstname . " " . $user->middlename . " " . $user->lastname}}</a></td>
                                <td>
                                {{$user->deleted}}
                                </td>
                            </tr>
                        
                            
                        @endforeach
                        </table>
                        
                        
                    @endif
                    
                    

                </div>


            </div>
        <!-- </div> -->
    </div>
</div>
@endsection