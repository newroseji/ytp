@extends('layouts.blog_tpl')
@section('breadcrumbs', Breadcrumbs::render('categories.index'))
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <!-- <div class="col-md-12"> -->
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
                <div class="card-header"><h5>All Categories</h5>
                <p class="text-muted">Displaying {{$categories->count() }} out of {{$categories->total()}}</p>
                
                </div>

                <div class="card-body">
                    

                    @if($categories->count())
                        <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description</th>
                        </tr>

                        @foreach($categories as $category)
                        <tr>
                            <td>{{$category->id}}</td>
                            <td>{{ $category->name }}</td>
                            <td>
                                <div class="d-flex justify-content-between"> 
                                    {{ $category->description }}&nbsp;
                                    
                                        @if(Auth::user() && Auth::user()->admin)
                                           <div class="d-flex justify-content-around h-25">
                                        
                                                <a href="{{ route('categories.edit',$category->id)}}" 
                                                class="btn btn-primary btn-sm">Edit</a>&nbsp;

                                                <form action="{{ route('categories.destroy', $category->id)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm" type="submit">Del</button>
                                                </form>
                                            </div>
                                        @endif

                                        

                                </div>
                            </td>
                            
                        </tr>
                        
                            
                        @endforeach
                        </table>
                        
                        {{ $categories->onEachSide(1)->links() }}
                    @endif
                    
                    

                </div>


            </div>
        <!-- </div> -->
    </div>
</div>
@endsection