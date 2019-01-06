@extends('layouts.blog_tpl')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

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


    <div class="card">
        <div class="card-header">
            <div class="d-flex">
                <div class="mr-auto p-2"
                data-toggle="collapse" 
                data-target="#collapseAds" 
                aria-expanded="false" 
                aria-controls="collapseAds"
                style="cursor:pointer">My Ads
            </div>
            <div class="p-2">
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#adModal">
                    Create new Ad
                </button>
            </div>
        </div>
    </div>
    
    <div class="collapse show" id="collapseAds">
        <div class="card-body">
            @if($user->ads->count())

            <table class="table table-responsive table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Created at</th>
                        <th>Price</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>    
                </thead>
                <tbody>
                    @foreach($ads as $ad)
                    <tr class="{{ $ad->active ? '' : 'text-muted' }}">
                        <td>{{$ad->id}}</td>
                        <td><a href="{{ route('ads.show',$ad->id) }}">{{ $ad->title }}</a></td>
                        <td><a href="{{ route('categories.show',$ad->category_id)}}">{{ $ad->category->name }}</a></td>
                        <td>{{$ad->created_at}}</td>
                        <td>{{$ad->price ? 'Rs. ' . $ad->price : ''}}</td>
                        <td>
                            <span class="badge {{ $ad->active ? 'badge-success' : 'badge-danger' }}">{{ $ad->active ? 'Active' : 'Inactive' }}</span>
                        </td>
                        
                        <td><a href="{{ route('ads.edit',$ad->id)}}" class="btn btn-primary btn-sm">edit</a>
                            <a href="#" class="btn btn-sm btn-danger">del</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            
            @endif
        </div>
    </div>
</div>                   

<div class="card">
    <div class="card-header">
        <div class="d-flex">
            <div class="mr-auto p-2"
            data-toggle="collapse" 
            data-target="#collapseEmails" 
            aria-expanded="false" 
            aria-controls="collapseEmails"
            style="cursor:pointer">Send emails
        </div>
        <div class="p-2">
            &nbsp;
        </div>
    </div>
</div>

<div class="collapse show" id="collapseEmails">
    <div class="card-body">
        <form name="emailForm" role="form" method="POST" action="{{ url('send/email') }}">
            <div class="card-body">
                
                @csrf
                <label for="email">Email</label>
                <input type="email" id="email" name="txt_email" autofocus placeholder="Email address only">

                
            </div>
            <div class="card-footer">
                <input type="submit" value="Send a test email" class="btn btn-primary btn-sm d-inline">
                <input type="reset" value="Clear" class="btn btn-sm btn-danger btn-o">
                
            </div>
        </form>
    </div>
</div>
</div>


</div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="adModal" 
tabindex="-1" role="dialog" 
aria-labelledby="adModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="adModalLabel">New Ad</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <div class="modal-body">


      <form method="POST" action="{{ route('ads.store') }}">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" 
            autofocus
            required class="form-control"
            placeholder="Title of the Ad">
            
            @if($errors->has('title'))
            
            {!! $errors->first('title') !!} 
            
            @endif
            
        </div>

        <div class="form-group">
            
            <textarea  cols="50" rows="5" class="form-control" id="description" name="description" required
            >Default text here
        </textarea>
        @if($errors->has('description'))
        {!! $errors->first('description') !!} 
        @endif
    </div>

    <div class="form-group">
        <label for="category">Category</label>
        <input type="text" id="category" class="form-control" name="category" required
        placeholder="Category of the Ad">
        @if($errors->has('category'))
        {!! $errors->first('category') !!} 
        @endif
    </div>

    <div class="form-group">
        <label for="price">Price</label>
        <input type="text" id="price" class="form-control"
        name="price" required placeholder="Price of the Ad">
        @if($errors->has('price'))
        {!! $errors->first('price') !!} 
        @endif
    </div>

    <div class="d-block">
        <input type="submit" value="Post" class="btn btn-primary">
    </div>
</form>

@if (count($errors) > 0)
<div class="error">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

</div>

</div>
</div>

</div>
@endsection
