@extends('layouts.blog_tpl')
@section('breadcrumbs', Breadcrumbs::render('users.show',$user))
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

                   <div class="card">
                        <div class="card-header">
                            <div class="d-flex">
                                <div class="mr-auto p-2"
                                    data-toggle="collapse" 
                                    data-target="#collapseProfile" 
                                    aria-expanded="false" 
                                    aria-controls="collapseProfile"
                                    style="cursor:pointer">
                                    @if(Auth::user() && Auth::user()->id == $user->id)My
                                    @else
                                    User
                                    @endif
                                     Profile
                                </div>
                                @if(Auth::user() && Auth::user()->id == $user->id)
                                    <div class="p-2">
                                            <a href="{{ route('users.edit',$user->id)}}" class="btn btn-primary btn-sm" 
                                            >
                                            Edit
                                            </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="collapse show" id="collapseProfile">
                            <div class="card-body">
                            <table class="table table-responsive">
                                <tr><th>Fullname</th><td>{{ $user->firstname . " " .  $user->middlename . " " . $user->lastname }}</td></tr>
                                <tr><th>Email</th><td>{{$user->email}}</td></tr>
                                <tr><th>Home Phone</th><td>{{$user->phone}}</td></tr>
                                <tr><th>Mobile</th><td>{{ $user->mobile}}</td></tr>
                                <tr><th>Address</th><td>{{$user->street . ' ' . $user->area . ' ' . $user->city}}</td></tr>
                            </table>
                            </div>
                        </div>
                   </div> 

                                     

                   

            
        </div>
    </div>
</div>

@endsection
