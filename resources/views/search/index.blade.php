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
                                    Search results for <strong>{!! $results['q'] !!}</strong>
                                </div>
                                
                                    <div class="p-2">
                                            <a href="{{ route('search') }}" 
                                            class="btn btn-primary btn-sm" 
                                            >
                                            Advanced search
                                            </a>
                                    </div>
                                
                            </div>
                        </div>
                        
                        <div class="collapse show" id="collapseUsers">
                            <div class="card-body">

                            @if(count($results['users'])<=0 
                            && count($results['ads'])<=0
                            && count($results['categories'])<=0)
                                Not found.
                            @endif

                            @if($results['users'] &&  Auth::user())

                                <table class="table table-striped">
                                <caption style="caption-side:top">Users</caption>  
                                <thead>
                                
                                    <tr>
                                        <th>Fullname</th>
                                        <th>Email</th>
                                        <th>Home</th>
                                        <th>Mobile</th>
                                        <th>Street</th>
                                        <th>Area</th>
                                        <th>City</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($results['users'] as $user)
                                    <tr>
                                    <td><a href="{{ route('users.show',$user->id)}}">{{$user->firstname . " " . $user->middlename . " " . $user->lastname}}</a></td>
                                    <td>{{ $user->email}}</td>
                                    <td>{{ $user->home}}</td>
                                    <td>{{ $user->mobile}}</td>
                                    <td>{{ $user->street}}</td>
                                    <td>{{ $user->area}}</td>
                                    <td>{{ $user->city}}</td>
                                </tr>
                                    @endforeach
                                </tbody>
                                </table>
                            @endif

                            @if($results['ads'])
                            <table class="table table-striped">
                            <caption style="caption-side:top"><a href="{{ route('ads.index')}}">Ads</a></caption>    
                            <thead>
                            <tr><th>Title</th><th>Description</th></tr>
                            </thead>
                            <tbody>
                                @foreach($results['ads'] as $ad)
                                    <tr><td><a href="{{ route('ads.show',$ad->id) }}">{!! str_replace($results['q'] ,"<span class='highlight'>" . $results['q'] . "</span>",$ad->title) !!}</a></td>
                                    <td>{!! str_replace($results['q'] ,"<span class='highlight'>" . $results['q'] . "</span>",$ad->description) !!}</td></tr>
                                @endforeach
                                </tbody>
                            </table>
                            @endif

                            @if($results['categories'])
                            
                            <table class="table table-striped">
                            <caption style="caption-side:top"><a href="{{ route('categories.index')}}">Categories</a></caption>    
                            <thead>
                            <tr><th>Name</th><th>Description</th></tr>
                            </thead>
                            <tbody>
                                @foreach($results['categories'] as $cat)
                                    <tr><td>{!! str_replace($results['q'] ,"<span class='highlight'>" . $results['q'] . "</span>",$cat->name) !!}</td>
                                    <td>{!! str_replace($results['q'] ,"<span class='highlight'>" . $results['q'] . "</span>",$cat->description) !!}</td></tr>
                                @endforeach
                                </tbody>
                                </table>
                            @endif
                            

                            </div>
                        </div>
                   </div>      

                   

            
        </div>
    </div>
</div>

@endsection
