@extends('layouts.blog_tpl')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

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

                    <!-- Need a panel for all users -->

                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex">
                                <div class="mr-auto p-2"
                                    data-toggle="collapse" 
                                    data-target="#collapseUsers" 
                                    aria-expanded="false" 
                                    aria-controls="collapseUsers"
                                    style="cursor:pointer">
                                    All Users
                                </div>
                                
                                    <div class="p-2">
                                            <a href="{{ route('users.create') }}" 
                                            class="btn btn-primary btn-sm" 
                                            >
                                            Add new user
                                            </a>
                                    </div>
                                
                            </div>
                        </div>
                        
                        <div class="collapse show" id="collapseUsers">
                            <div class="card-body">
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th>Fullname</th>
                                        <th>Email</th>
                                        <th>Active</th>
                                        <th>Verified</th>
                                        <th>Created Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                    <tr>
                                    <td><a href="{{ route('users.show',$user->id)}}">{{$user->firstname . " " . $user->middlename . " " . $user->lastname}}</a></td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->active}}</td>
                                    <td>{{$user->email_verified_at}}</td>
                                    <td>{{$user->created_at}}</td>
                                    <td>
                                        <a href="{{ route('users.edit',$user->id) }}" 
                                            class="btn btn-primary btn-sm">edit</a>

                                        @if( Auth::user()->id !=$user->id)
                                            <form action="{{ route('users.destroy', $user->id)}}" 
                                            method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm" type="submit">Del</button>
                                            </form>
                                        @endif

                                    </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                </table>
                            </div>
                        </div>
                   </div> 


                   <div class="card">
                        <div class="card-header">
                            <div class="d-flex">
                                <div class="mr-auto p-2"
                                    data-toggle="collapse" 
                                    data-target="#collapseCategories" 
                                    aria-expanded="false" 
                                    aria-controls="collapseCategories"
                                    style="cursor:pointer">
                                    All Categories
                                </div>
                                
                                    <div class="p-2">
                                            <a href="{{ route('categories.create') }}" class="btn btn-primary btn-sm" 
                                            >
                                            Add new category
                                            </a>
                                    </div>
                                
                            </div>
                        </div>
                        
                        <div class="collapse show" id="collapseCategories">
                            <div class="card-body">
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Created Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($categories as $cat)
                                    <tr>
                                    <td>{{$cat->name}}</td>
                                    <td>{{$cat->description}}</td>
                                    <td>{{$cat->created_at}}</td>
                                    <td>
                                        <a href="{{ route('categories.edit',$cat->id) }}" 
                                            class="btn btn-primary btn-sm">edit</a>

                                        <form action="{{ route('categories.destroy', $cat->id)}}" 
                                        method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" type="submit">Del</button>
                                        </form>

                                    </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                </table>
                            </div>
                        </div>
                   </div> 

                                     

                   

            
        </div>
    </div>
</div>

@endsection
