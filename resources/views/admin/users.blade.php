@extends('layouts.blog_tpl')

@section('content')
<div class="container">
    <div class="justify-content-center">
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
                        class="btn btn-primary btn-sm ml-auto p-2 h-25">Create User</a>

                    </div>

                </div>

                <div class="card-body">
                    

                    @if($users->count())
                        <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Fullname</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Verified</th>
                                        <th>Created Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                        
                                        <tr>
                                            <td><a href="{{ route('users.show',$user->id)}}">{{$user->firstname . " " . $user->middlename . " " . $user->lastname}}</a></td>
                                            <td>{{$user->email}}</td>
                                            <td>
                                                <div class="d-flex justify-content-between">
                                                    
                                                    <span class="h-25 badge {{ $user->deleted ? 'badge-danger' : 'badge-success' }}">{{ $user->deleted ? 'Deleted' : '' }}</span>

                                                    <span class="h-25 badge {{ $user->active ? $user->deleted ? 'badge-warning' : 'badge-success' : 'badge-danger' }}">{{ $user->active ? 'Active' : 'Inactive' }}</span>

                                                </div>

                                            </td>
                                            <td>{{$user->email_verified_at}}</td>
                                            <td>
                                                <div class="d-flex justify-content-between">

                                                    <span>
                                                        {{$user->created_at}}
                                                    </span>&nbsp;

                                                    @if (Auth::user() && (Auth::user()->id ==$user->id || Auth::user()->admin) )

                                                        <div class="d-flex justify-content-around">
                                                        
                                                            <a href="{{ route('users.edit',$user->id) }}" 
                                                                class="btn btn-primary btn-sm">edit</a>&nbsp;

                                                            @if( Auth::user()->id !=$user->id)

                                                                <form action="{{ route('users.destroy', $user->id)}}" 
                                                                method="post">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button class="btn btn-danger btn-sm" type="submit">Del</button>
                                                                </form>
                                                            @endif
                                                        </div>
                                                    @endif

                                                </div>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                </table>
                        
                        
                    @endif
                    
                    

                </div>


            </div>
        <!-- </div> -->
    </div>
</div>
@endsection