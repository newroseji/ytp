@extends('layouts.blog_tpl')

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
                                        class="d-inline p-2 bg-primary text-white">Edit</a>

                                        <form action="{{ route('categories.destroy', $category->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="d-inline p-2 bg-danger text-white" type="submit">Del</button>
                                        </form>
                        
                                    @endif
                    

                    
                </div>

                <div class="card-body">

                   

                    <p>{!! $category->description !!}
                    

                </div>

                <div class="card-footer">
                <a href="{{ URL::previous() }}" class="btn btn-info">Back</a>
                </div>


            </div>
        </div>
    </div>
</div>
@endsection