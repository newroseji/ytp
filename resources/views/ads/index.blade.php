@extends('layouts.blog_tpl')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h5>All Ads</h5>
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
                        <tr><th>ID</th><th>Title</th><th>Price (Rs)</th><th>Actions</th></tr>

                        @foreach($ads as $ad)
                        <tr>
                            <td>{{$ad->id}}</td>
                            <td><a href="{{ route('ads.show',$ad->id) }}">{{ $ad->title }}</a></td>
                            <td>{{$ad->price}}</td>
                            <td>
                            <div class="d-flex justify-content-around">
                                <a href="{{ route('ads.edit',$ad->id)}}" 
                                class="btn btn-primary btn-sm">Edit</a>

                                <form action="{{ route('ads.destroy', $ad->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" type="submit">Del</button>
                                </form>

                            </div>
                            </td>
                        </tr>
                        
                            
                        @endforeach
                        </table>
                        
                        {{ $ads->onEachSide(1)->links() }}
                    @endif
                    
                    

                </div>


            </div>
        </div>
    </div>
</div>
@endsection