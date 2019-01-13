@extends('layouts.blog_tpl')
@section('breadcrumbs', Breadcrumbs::render('dashboard'))
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
                                    data-target="#collapseAds" 
                                    aria-expanded="false" 
                                    aria-controls="collapseAds"
                                    style="cursor:pointer">My Ads
                                </div>
                                <div class="p-2">
                                <a href="{{route('ads.create') }}" class="btn btn-primary btn-sm" 
                                >
                            Create new Ad
                            </a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="collapse show" id="collapseAds">
                            <div class="card-body">
                            @if($user->ads->count())

                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Created at</th>
                                        <th>Price</th>
                                        <th>Active</th>
                                    </tr>    
                                </thead>
                                <tbody>
                                    @foreach($ads as $ad)
                                        <tr class="{{ $ad->active ? '' : 'text-muted' }}">
                                            <td>{{$ad->id}}</td>
                                            <td><a href="{{ route('ads.show',$ad->id) }}">{{ $ad->title }}</a></td>
                                            <td><a href="{{ route('categories.show',$ad->category_id)}}">{{ $ad->category->name }}</a></td>
                                            <td>{{$ad->created_at}}</td>
                                            <td>{{$ad->price ? 'Rs. ' . $ad->price : ''}}</td>
                                            <td>

                                                <div class="d-flex align-items-center justify-content-between">
                                                    <span class="h-25 badge {{ $ad->active ? 'badge-success' : 'badge-danger' }}">{{ $ad->active ? 'Active' : 'Inactive' }}</span>
                                          
                                                    @if(Auth::user() )
                                                        <span class="d-flex justify-content-end">
                                                            @if (Auth::user()->id == $ad->user_id || Auth::user()->admin )
                                                                <a href="{{ route('ads.edit',$ad->id)}}" 
                                                                    class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o"></i></a>&nbsp;
                                                                <form action="{{ route('ads.destroy', $ad->id)}}" method="post">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button class="btn btn-danger btn-sm" type="submit"><i class="fa fa-trash-o"></i></button>
                                                                </form>
                                                            @endif
                                                        </span>
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
                   </div>                   

                   <div class="card">
                        <div class="card-header">
                            <div class="d-flex">
                                <div class="mr-auto p-2"
                                    data-toggle="collapse" 
                                    data-target="#collapseEmails" 
                                    aria-expanded="false" 
                                    aria-controls="collapseEmails"
                                    style="cursor:pointer">Send emails
                                </div>
                                <div class="p-2">
                                &nbsp;
                                </div>
                            </div>
                        </div>
                        
                        <div class="collapse show" id="collapseEmails">
                            <div class="card-body">
                                <form name="emailForm" role="form" method="POST" action="{{ url('send/email') }}">
                                    <div class="card-body">
                                    
                                            @csrf
                                            <label for="email">Email</label>
                                            <input type="email" id="email" name="txt_email" autofocus placeholder="Email address only">

                                            
                                    </div>
                                    <div class="card-footer">
                                    <input type="submit" value="Send a test email" class="btn btn-primary btn-sm d-inline">
                                            <input type="reset" value="Clear" class="btn btn-sm btn-danger btn-o">
                                    
                                    </div>
                                </form>
                            </div>
                        </div>
                   </div>

            

        </div>
    </div>
</div>
@endsection
