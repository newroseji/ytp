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
                                    <td>
                                        <span class="d-flex justify-content-between">
                                            <span>{{$cat->created_at}}</span>



                                            @if(Auth::user() )

                                            @if (Auth::user()->id == $cat->user_id || Auth::user()->admin )

                                            <span class="d-flex justify-content-around h-25">
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

                                        <td><a href="{{ route('ads.show',$ad->id) }}">{{ $ad->title }}</a>
                                            @if($ad->advisits()->count()>0)
                                            <span class="text-sm" title="Visits">
                                                <a href="#" class="badge badge-pill badge-info" data-toggle="modal" data-target="#adVisitModal{{$ad->id}}">{{ $ad->advisits()->count() }}</a>
                                            </span>

                                            <!-- Modal -->
                                            <div class="modal fade" id="adVisitModal{{$ad->id}}" tabindex="-1" role="dialog" aria-labelledby="adVisitModalLabel" aria-hidden="true">
                                              <div class="modal-dialog modal-md" role="document">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <h5 class="modal-title" id="adVisitModalLabel">Ad visits ({{$ad->advisits()->count()}})</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">&times;</span>
                                                  </button>
                                              </div>
                                              <div class="modal-body">
                                                <div class="row"> 
                                                    @if($ad->advisits()->count()>0)
                                                    <div style="height: 250px;overflow: auto" class="col-md-8 offset-md-2">
                                                        <table class="table table-responsive table-striped table-hover"> 
                                                            <tr><th>User</th><th>Visited at</th></tr>
                                                            @foreach($ad->advisits as $adv)
                                                            <tr><td>
                                                                @if($adv->user_id)
                                                                <a href="{{ route('users.show',$adv->user_id)}}">
                                                                {{ $adv->user($adv->user_id) }}
                                                                </a>
                                                                @else
                                                                guest
                                                                @endif
                                                            </td>
                                                                <td>{{$adv->created_at}}</td></tr>
                                                            @endforeach
                                                        </table>
                                                    </div>
                                                    @endif
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                                @endif
                            </td>
                            <td><a href="{{ route('categories.show',$ad->category_id)}}" class="badge badge-pill badge-info">{{ $ad->category->name }}</a></td>
                            <td>{{ $ad->price ? 'Rs. ' . number_format($ad->price, 2) : '' }}</td>

                            <td><span class="{{Carbon\Carbon::now()->format('m/d/y h:i:s')>$ad->expires ? 'text-danger' : '' }}">{{$ad->expires}}</span></td>
                            <td>
                                <div class="d-flex justify-content-between">
                                    <span>
                                        <a href="{{ route('users.show',$ad->user_id)}}">{{$ad->user->firstname . " " . $ad->user->middlename . " " . $ad->user->lastname}}</a></span>&nbsp;

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


                        {{ $ads->appends(['type'=>'ads'])->links() }}



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

