<!DOCTYPE html>
<html>
<head>
    <title>Normalized Ads</title>
</head>
<body>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet">
<div>
	@if(count($normalized)>0)
	<table class="table table-bordered">
<caption>{{ count($normalized) }} ads has been normalized.</caption>
			

            <thead>
                <tr>
                    <th>Ad ID</th>
                    <th>Title</th>
                    <th>Category</th>

                    <th>Price</th>
                    <th>Seller</th>
                    <th>Created at</th>
                    <th>Deleted at</th>
                </tr>
                </thead>
                <tbody>

                    @foreach($normalized as $ad)
                        <tr>
                            <td>{{$ad->id}}</td>
                            <td>{{ $ad->title }}</td>
                            <td>{{ $ad->category->name }}</td>
                            <td>{{ $ad->price ? 'Rs. ' . number_format($ad->price, 2) : '' }}</td>
                            <td>{{$ad->user->firstname . " " . $ad->user->middlename . " " . $ad->user->lastname}}</td>
                            <td>{{ $ad->created_at->format('M d, Y \a\t h:i A') }}</td>
                            <td>{{ $ad->updated_at->format('M d, Y \a\t h:i A') }}</td>
                        </tr>


                    @endforeach
                </tbody>
            </table>


	@endif
</div>
</body>
</html>