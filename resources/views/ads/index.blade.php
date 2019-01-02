@extends('layouts.blog_tpl')
@section('breadcrumbs', Breadcrumbs::render('ads.index'))
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <!-- <div class="col-md-12"> -->
            <div class="card">
                <div class="card-header">
                    <div class="d-flex">
                        <h5 class="p-2">All Ads</h5>
                        <a href="{{ route('ads.create')}}" 
                        class="btn btn-primary btn-sm ml-auto p-2">New Ad</a>
                    </div>
                    <p class="text-muted">Displaying {{$ads->count() }} out of {{$ads->total()}}</p>
                
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

                    @if($ads->count())
                        <table class="table table-bordered">
                        <thead>
                        <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Category</th>

                        <th>Price (Rs)</th>
                        <th>Seller</th><th>Actions</th></tr>

                        @foreach($ads as $ad)
                        <tr>
                            <td>{{$ad->id}}</td>
                            <td><a href="{{ route('ads.show',$ad->id) }}">{{ $ad->title }}</a></td>
                            <td><a href="{{ route('categories.show',$ad->category_id)}}">{{ $ad->category->name }}</a></td>
                            <td>{{$ad->price}}</td>
                            <td><a href="{{ route('users.show',$ad->user_id)}}">{{$ad->user->firstname . " " . $ad->user->middlename . " " . $ad->user->lastname}}</a></td>
                            <td>
                            <div class="d-flex justify-content-around">
                                @if(Auth::user() )
                                    @if (Auth::user()->id == $ad->user_id)
                                        <a href="{{ route('ads.edit',$ad->id)}}" 
                                        class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o"></i></a>

                                        <form action="{{ route('ads.destroy', $ad->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" type="submit"><i class="fa fa-trash-o"></i></button>
                                        </form>
                                    @endif
                                @endif

                            </div>
                            </td>
                        </tr>
                        
                            
                        @endforeach
                        </table>
                        
                        {{ $ads->onEachSide(1)->links() }}
                    @endif
                    
                    

                </div>


            </div>
        <!-- </div> -->
    </div>
</div>
@endsection