@extends('layouts.blog_tpl')
@section('breadcrumbs', Breadcrumbs::render('ads.show',$ad))
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
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

                <div class="card-header">

                    <h3>{{ $ad->title }}<span class="float-right">{{ $ad->price ? 'Rs. ' . number_format($ad->price, 2) : '' }}</span>
                    </h3>
                        <p class="lead">
                            <i class="fa fa-user"></i> by <a href="{{ route('users.show',$ad->user_id)}}">{{$ad->user->firstname . " " . $ad->user->middlename . " " . $ad->user->lastname}}</a>

                            

                        </p>
                        <hr class="pb-0 mb-1">
                        <p class="pb-0 mb-0"><i class="fa fa-calendar"></i> Posted on {{ $ad->created_at->format('M d, Y \a\t h:i A') }}
                            @if (Auth::user() && Auth::user()->id == $ad->user_id)

                                <div class="float-right">
                                    <a href="{{ route('ads.edit',$ad->id)}}" 
                                    class="btn btn-primary btn-sm">Edit</a>

                                    <form action="{{ route('ads.destroy', $ad->id)}}" method="post" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" type="submit">Del</button>
                                    </form>
                                </div>
                            @endif
                        </p>
                        <p class="pb-0 mb-0"><i class="fa fa-tags"></i> Category: <a href="{{ route('categories.show',$ad->category_id)}}" class="badge badge-info">
                            {{ $ad->category->name }}</a>

                        </p>

                            



                </div>

                <div class="card-body">



                                <p>{!! $ad->description !!}</p>


                </div>
                        </div>
                    </div>
                </div>
            </div>
            @endsection