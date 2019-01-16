@extends('layouts.blog_tpl')
@section('breadcrumbs', Breadcrumbs::render('dashboard'))
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

        


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
                                            
                                            <th>Title</th>
                                            <th>Price</th>
                                            <th>Category</th>
                                            <th>Created at</th>
                                            
                                            <th>Expires</th>
                                            <th>Publish</th>

                                            <th>Status</th>
                                        </tr>    
                                    </thead>
                                    <tbody>
                                        @foreach($ads as $ad)
                                            <tr class="{{ $ad->active ? '' : 'table-warning' }}">
                                                
                                                <td><a href="{{ route('ads.show',$ad->id) }}">{{ $ad->title }}</a></td>
                                                <td>{{$ad->price ? 'Rs. ' . $ad->price : ''}}</td>
                                                <td><a href="{{ route('categories.show',$ad->category_id)}}" class="badge badge-pill badge-info">{{ $ad->category->name }}</a></td>
                                                <td>{{$ad->created_at->format('m/d/y h:i A') }}</td>
                                                
                                                <td><span class="{{Carbon\Carbon::now()->format('m/d/y h:i:s')>$ad->expires ? 'text-danger' : '' }}">{{$ad->expires}}</span></td>
                                                <td>{{$ad->publish}}</td>
                                                <td>

                                                    <div class="d-flex align-items-center justify-content-start">
                                                        <span class="h-25 badge {{ $ad->deleted ? 'badge-danger' : 'badge-success' }}">{{ $ad->deleted ? 'Deleted' : '' }}</span>
&nbsp;
                                                        <span class="h-25 badge {{ $ad->active ? $ad->deleted ? 'badge-info' : 'badge-success' : 'badge-warning' }}">{{ $ad->active ? 'Active' : 'Inactive' }}</span>

                                                        &nbsp;
                                              
                                                        @if(Auth::user() && !$ad->deleted)
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
                                {{ $ads->onEachSide(1)->links() }}

                            @else
                                <span class="badge badge-info">Not found</span>

                            
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
