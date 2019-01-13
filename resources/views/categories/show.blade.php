@extends('layouts.blog_tpl')
@section('breadcrumbs', Breadcrumbs::render('categories.show',$category))
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

                    <h3>{{ $category->name }}</h3>
                        
                        <hr class="pb-0 mb-1">
                        <div class="pb-0 mb-0 d-flex justify-content-between">
                            <span>
                                <i class="fa fa-calendar"></i> Created on {{ $category->created_at->format('M d, Y \a\t h:i A') }}
                            </span>
                            
                            @if (Auth::user() && Auth::user()->admin )
                                <span class="d-flex justify-content-around">
                                        <a href="{{ route('categories.edit',$category->id)}}" 
                                        class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o"></i> edit</a>&nbsp;

                                        <form action="{{ route('categories.destroy', $category->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" 
                                            type="submit"><i class="fa fa-trash-o"></i> del</button>
                                        </form>
                                </span>
                            @endif
                        </div>
                    
                </div>

                <div class="card-body">

                   

                    <p>{!! $category->description !!}
                    

                </div>

            </div>
        </div>
    </div>
</div>
@endsection