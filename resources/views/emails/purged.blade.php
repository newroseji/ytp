<div>
	@if(count($purged)>0)
	<table class="table table-striped table-responsive table-hover">
<caption>{{ count($purged) }} ads has been purged.</caption>
			

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Category</th>

                    <th>Price</th>
                    <th>Seller</th><th>&nbsp;</th></tr>
                </thead>
                <tbody>

                    @foreach($purged as $ad)
                    <tr>
                        <td>{{$ad->id}}</td>
                        <td><a href="{{ route('ads.show',$ad->id) }}">{{ $ad->title }}</a></td>
                        <td><a href="{{ route('categories.show',$ad->category_id)}}">{{ $ad->category->name }}</a></td>
                        <td>{{ $ad->price ? 'Rs. ' . number_format($ad->price, 2) : '' }}</td>
                        <td><a href="{{ route('users.show',$ad->user_id)}}">{{$ad->user->firstname . " " . $ad->user->middlename . " " . $ad->user->lastname}}</a></td>
                        <td>
                            <div class="d-flex justify-content-around">

                                @if(Auth::user() )
                                    @if (Auth::user()->id == $ad->user_id || Auth::user()->admin )
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
                    </tbody>
                    </table>


	@endif
</div>