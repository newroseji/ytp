@extends('layouts.blog_tpl')
@section('breadcrumbs', Breadcrumbs::render('ads.show',$ad))
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
        
            <div class="card">
                @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                @endif

                <div class="card-header">

                    <div class="d-flex">
                        <div class="p-2">{{ $ad->title }}</div>
                        <div class="p-2 text-muted"><a href="{{ route('categories.show',$ad->category_id)}}">
                                {{ $ad->category->name }}
                            </a></div>
                        <div class="ml-auto p-2">{{ $ad->price ? 'Rs. ' . $ad->price : '' }}</div>
                    </div>
                    <span class="text-muted">{{ $ad->created_at->diffForHumans() }}</span>
                    
                    @if (Auth::user() && Auth::user()->id == $ad->user_id)
                        
                                        <a href="{{ route('ads.edit',$ad->id)}}" 
                                        class="d-inline p-2 bg-primary text-white">Edit</a>

                                        <form action="{{ route('ads.destroy', $ad->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="d-inline p-2 bg-danger text-white" type="submit">Del</button>
                                        </form>
                        
                                    @endif
                    

                    
                </div>

                <div class="card-body">

                   

                    <p>{!! $ad->description !!}</p>
                    

                </div>
            </div>
        </div>
    </div>
</div>
@endsection