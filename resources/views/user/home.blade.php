@extends('layouts.blog_tpl')
@section('breadcrumbs', Breadcrumbs::render('dashboard'))
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">




         <div class="card">
            <div class="card-header">


                <div class="d-flex bd-highlight mb-3">
                    <div class="mr-auto p-2 bd-highlight"
                    data-toggle="collapse" 
                    data-target="#collapseAds" 
                    aria-expanded="false" 
                    aria-controls="collapseAds"
                    style="cursor:pointer"
                    ><h5>My Ads</h5></div>
                    <div class="p-2 bd-highlight">
                        <span class="btn btn-sm btn-warning">expired
                                <span class="badge badge-pill badge-light">{{ App\Ad::expired(null,$user->id)->count() }}</span>
                            </span>
                    </div>
                    <div class="p-2 bd-highlight">
                        <span class="btn btn-sm btn-danger">deleted 
                            <span class="badge badge-pill badge-light">{{ App\Ad::erased(\Auth::user()->id)->count() }}</span></span>

                            <span class="btn btn-sm btn-success">active
                                <span class="badge badge-pill badge-light">{{ App\Ad::noterased(\Auth::user()->id)->count() }}</span>
                            </span>

                            <span class="btn btn-sm btn-info">total
                                    <span class="badge badge-pill badge-light">{{ $user->ads->count() }}</span>
                                </span>

                            

                        </div>
                        <div class="p-2 bd-highlight"><a href="{{ route('ads.create') }}" class="btn btn-primary btn-sm" 
                            >
                            Add new Ad
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

                                <th>&nbsp;</th>
                            </tr>    
                        </thead>
                        <tbody>
                            @foreach($ads as $ad)
                            <tr class="{{ $ad->deleted ? 'table-danger' : '' }}">

                                <td><a href="{{ route('ads.show',$ad->id) }}">{{ $ad->title }}</a></td>
                                <td>{{$ad->price ? 'Rs. ' . $ad->price : ''}}</td>
                                <td><a href="{{ route('categories.show',$ad->category_id)}}" class="badge badge-pill badge-info">{{ $ad->category->name }}</a></td>
                                <td>{{$ad->created_at->format('m/d/y h:i A') }}</td>

                                <td><span class="{{Carbon\Carbon::now()->format('m/d/y h:i:s')>$ad->expires ? 'text-danger' : '' }}">{{$ad->expires}}</span></td>
                                <td>{{$ad->publish}}</td>
                                <td>

                                    <div class="d-flex align-items-center justify-content-start">

                                        @if(Auth::user())
                                        <a href="{{ route('ads.edit',$ad->id)}}" 
                                            class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o"></i></a>&nbsp;
                                            @if(!$ad->deleted)
                                            <span class="d-flex justify-content-end">
                                                @if (Auth::user()->id == $ad->user_id || Auth::user()->admin )
                                                
                                                <form action="{{ route('ads.destroy', $ad->id)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm" type="submit"><i class="fa fa-trash-o"></i></button>
                                                </form>
                                                @endif
                                            </span>
                                            @else
                                            <form action="{{ route('ads.destroy', $ad->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-success btn-sm" type="submit">restore</button>
                                            </form>

                                            @endif




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
