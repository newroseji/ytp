@extends('layouts.blog_tpl')
@section('breadcrumbs', Breadcrumbs::render('ads.index'))
@section('content')
<div class="container">
    <div class="justify-content-center">
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
                <div class="card-header">

                    <div class="d-flex flex-column bd-highlight mb-0">
                        <div class="p-2 bd-highlight">
                            <h5 class="float-left">All Ads</h5>

                            <a href="{{ route('ads.create')}}" 
                            class="btn btn-primary btn-sm float-right"><i class="fa fa-newspaper-o"></i> New Ad</a>
                        </div>
                        <div class="p-2 mb-0 bd-highlight">
                          <p class="text-muted">Displaying {{$ads->count() }} out of {{$ads->total()}}</p>
                      </div>
                      
                  </div>

              </div>

              <div class="card-body">


        @if($ads->count())
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    
                    <th>Title</th>
                    <th>Category</th>

                    <th>Price</th>
                    <th>Expires</th>
                    <th>Seller</th>

                    
                </tr>
                </thead>
                <tbody>

                    @foreach($ads as $ad)
                    <tr class="{{ Auth::user() && Auth::user()->id == $ad->user_id  ? 'table-success' : '' }}">
                       
                        <td><a href="{{ route('ads.show',$ad->id) }}">{{ $ad->title }}</a></td>
                        <td><a href="{{ route('categories.show',$ad->category_id)}}" class="badge badge-pill badge-info">{{ $ad->category->name }}</a></td>
                        <td>{{ $ad->price ? 'Rs. ' . number_format($ad->price, 2) : '' }}</td>
                        <td>{{ $ad->expires  }}</td>
                        <td>
                            <div class="d-flex justify-content-start">
                                <a href="{{ route('users.show',$ad->user_id)}}">{{$ad->user->firstname . " " . $ad->user->middlename . " " . $ad->user->lastname}}</a>&nbsp;

                                <span  class="d-flex justify-content-around h-25">

                                    @if(Auth::user() )
                                        @if (Auth::user()->id == $ad->user_id || Auth::user()->admin )
                                            <a href="{{ route('ads.edit',$ad->id)}}" 
                                                class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o"></i></a>&nbsp;

                                            <form action="{{ route('ads.destroy', $ad->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm" type="submit"><i class="fa fa-trash-o"></i></button>
                                            </form>
                                        @endif
                                    @endif

                                </span>

                            </div>
                        </td>
                    </tr>


                        @endforeach
                    </tbody>
                    </table>

                    {{ $ads->onEachSide(1)->links() }}

                    @else
                        <p><span class="badge badge-danger">No Ads found</span></p>
                    @endif



                </div>


            </div>
            <!-- </div> -->
        </div>
    </div>
    @endsection