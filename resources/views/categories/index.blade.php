@extends('layouts.blog_tpl')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <!-- <div class="col-md-12"> -->
            <div class="card">
                <div class="card-header"><h5>All Categories</h5>
                <p class="text-muted">Displaying {{$categories->count() }} out of {{$categories->total()}}</p>
                
                </div>

                <div class="card-body">
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

                    @if($categories->count())
                        <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>

                        @foreach($categories as $category)
                        <tr>
                            <td>{{$category->id}}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->description }}</td>
                            <td>
                            <div class="d-flex justify-content-around">
                                @if(Auth::user() )
                                    @if (Auth::user()->id == $category->user_id)
                                        <a href="{{ route('categories.edit',$category->id)}}" 
                                        class="btn btn-primary btn-sm">Edit</a>

                                        <form action="{{ route('categories.destroy', $category->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" type="submit">Del</button>
                                        </form>
                                    @endif
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