@extends('layouts.blog_tpl')
@section('breadcrumbs', Breadcrumbs::render('ads.index'))
@section('content')
<div class="container">
    <div class="justify-content-center">
        <!-- <div class="col-md-12"> -->
            <div class="card">
                
                <div class="card-header">

                   


<div class="d-flex bd-highlight mb-3">
                            <div class="mr-auto p-2 bd-highlight"
                            data-toggle="collapse" 
                            data-target="#collapseAds" 
                            aria-expanded="false" 
                            aria-controls="collapseAds"
                            style="cursor:pointer"
                            ><h5>All Ads</h5></div>
                            
                            <div class="p-2 bd-highlight">
                                <span class="btn btn-sm btn-warning">displaying
                                    <span class="badge badge-pill badge-success">{{ $ads->count() }}</span>
                                    out of 
                                    <span class="badge badge-pill badge-primary">{{ $ads->total() }}</span>
                                </span>
                            </div>
                            
                                <div class="p-2 bd-highlight"><a href="{{ route('ads.create') }}" class="btn btn-primary btn-sm" 
                                    >
                                    Add new Ad
                                </a>
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