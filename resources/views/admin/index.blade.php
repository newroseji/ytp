@extends('layouts.blog_tpl')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">



            <!-- users panel -->
            @include('admin.__users')

            <!-- Category panel -->
            <div class="card">
                <div class="card-header">

                    <div class="d-flex bd-highlight mb-3">
                        <div class="mr-auto p-2 bd-highlight"
                        data-toggle="collapse" 
                        data-target="#collapseCategories" 
                        aria-expanded="false" 
                        aria-controls="collapseCategories"
                        style="cursor:pointer"
                        ><h5>All Categories</h5></div>
                        <div class="p-2 bd-highlight">
                            <span class="btn btn-sm btn-danger">deleted 
                                <span class="badge badge-pill badge-light">{{ App\Category::erased()->count() }}</span></span>

                                <span class="btn btn-sm btn-success">active
                                    <span class="badge badge-pill badge-light">{{ App\Category::noterased()->count() }}</span>
                                </span>

                                <span class="btn btn-sm btn-info">total
                                    <span class="badge badge-pill badge-light">{{ $categories->count() }}</span>
                                </span>

                            </div>
                            <div class="p-2 bd-highlight"><a href="{{ route('categories.create') }}" class="btn btn-primary btn-sm" 
                                >
                                Add new category
                            </a>
                        </div>
                    </div>

                </div>

                <div class="collapse show" id="collapseCategories">
                    <div class="card-body">
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Created Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $cat)
                                <tr class="{{ $cat->deleted ? 'table-danger' : '' }}">
                                    <td>{{$cat->name}}</td>
                                    <td>{{$cat->description}}</td>
                                    <td>{{$cat->created_at}}</td>
                                    <td>

                                        <span  class="d-flex justify-content-around h-25">

                                            @if(Auth::user() )

                                            @if (Auth::user()->id == $cat->user_id || Auth::user()->admin )

                                            <span class="d-flex justify-content-end">
                                                <a href="{{ route('categories.edit',$cat->id) }}" 
                                                    class="btn btn-primary btn-sm">edit</a>&nbsp;

                                                    @if(!$cat->deleted)

                                                    <form action="{{ route('categories.destroy', $cat->id)}}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger btn-sm" type="submit"><i class="fa fa-trash-o"></i></button>
                                                    </form>
                                                    @else
                                                    <form action="{{ route('categories.destroy', $cat->id)}}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-success btn-sm" type="submit">restore</button>
                                                    </form>

                                                    @endif

                                                </span>

                                                @endif

                                                @endif

                                            </span>




                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> 

                <!-- Ads -->
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
                                <span class="btn btn-sm btn-warning">expired
                                    <span class="badge badge-pill badge-light">{{ App\Ad::expired()->count() }}</span>
                                </span>
                            </div>
                            <div class="p-2 bd-highlight">
                                <span class="btn btn-sm btn-danger">deleted 
                                    <span class="badge badge-pill badge-light">{{ App\Ad::erased()->count() }}</span></span>

                                    <span class="btn btn-sm btn-success">active
                                        <span class="badge badge-pill badge-light">{{ App\Ad::noterased()->count() }}</span>
                                    </span>

                                    <span class="btn btn-sm btn-info">total
                                        <span class="badge badge-pill badge-light">{{ $ads->total() }}</span>
                                    </span>



                                </div>
                                <div class="p-2 bd-highlight"><a href="{{ route('ads.create') }}" class="btn btn-primary btn-sm" 
                                    >
                                    Add new Ad
                                </a>
                            </div>
                        </div>

                    </div>




                    <div class="collapse show" id="collapseAds">
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
                                    <tr class="{{ $ad->deleted  ? 'table-danger' : '' }}">

                                        <td><a href="{{ route('ads.show',$ad->id) }}">{{ $ad->title }}</a></td>
                                        <td><a href="{{ route('categories.show',$ad->category_id)}}" class="badge badge-pill badge-info">{{ $ad->category->name }}</a></td>
                                        <td>{{ $ad->price ? 'Rs. ' . number_format($ad->price, 2) : '' }}</td>

                                        <td><span class="{{Carbon\Carbon::now()->format('m/d/y h:i:s')>$ad->expires ? 'text-danger' : '' }}">{{$ad->expires}}</span></td>
                                        <td>
                                            <div class="d-flex justify-content-start">
                                                <a href="{{ route('users.show',$ad->user_id)}}">{{$ad->user->firstname . " " . $ad->user->middlename . " " . $ad->user->lastname}}</a>&nbsp;

                                                <span  class="d-flex justify-content-around h-25">

                                                    @if(Auth::user() )

                                                    @if (Auth::user()->id == $ad->user_id || Auth::user()->admin )

                                                    <span class="d-flex justify-content-end">
                                                        <a href="{{ route('ads.edit',$ad->id)}}" 
                                                            class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o"></i></a>&nbsp;

                                                            @if(!$ad->deleted)

                                                            <form action="{{ route('ads.destroy', $ad->id)}}" method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-danger btn-sm" type="submit"><i class="fa fa-trash-o"></i></button>
                                                            </form>
                                                            @else
                                                            <form action="{{ route('ads.destroy', $ad->id)}}" method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-success btn-sm" type="submit">restore</button>
                                                            </form>

                                                            @endif

                                                        </span>

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
                    </div> <!-- End of card div -->








                </div>
            </div>
        </div>

        @endsection
