@extends('layouts.blog_tpl')
@section('breadcrumbs', Breadcrumbs::render('categories.show',$category))
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
                        <div class="p-2">{{ $category->name }}</div>
                        
                       
                    </div>
                    <span class="text-muted">{{ $category->created_at->diffForHumans() }}</span>
                    
                    @if (Auth::user() && Auth::user()->admin )
                        
                                        <a href="{{ route('categories.edit',$category->id)}}" 
                                        class="bg-primary text-white btn btn-sm"><i class="fa fa-pencil-square-o"></i> edit</a>

                                        <form action="{{ route('categories.destroy', $category->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn-sm bg-danger text-white" 
                                            type="submit"><i class="fa fa-trash-o"></i> del</button>
                                        </form>
                        
                                    @endif
                    

                    
                </div>

                <div class="card-body">

                   

                    <p>{!! $category->description !!}
                    

                </div>

            </div>
        </div>
    </div>
</div>
@endsection