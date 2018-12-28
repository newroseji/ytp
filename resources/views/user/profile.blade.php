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
                                    data-target="#collapseProfile" 
                                    aria-expanded="false" 
                                    aria-controls="collapseProfile"
                                    style="cursor:pointer">My Profile
                                </div>
                                <div class="p-2">
                                        <a href="{{ route('users.edit',$user->id)}}" class="btn btn-primary btn-sm" 
                                        >
                                        Edit
                                        </a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="collapse" id="collapseProfile">
                            <div class="card-body">
                            <table class="table table-responsive">
                                <tr><th>Fullname</th><td>{{ $user->firstname . " " .  $user->middlename . " " . $user->lastname }}</td></tr>
                                <tr><th>Email</th><td>{{$user->email}}</td></tr>
                                <tr><th>Home Phone</th><td>{{$user->phone}}</td></tr>
                                <tr><th>Mobile</th><td>{{ $user->mobile}}</td></tr>
                                <tr><th>Address</th><td>{{$user->street . ' ' . $user->area . ' ' . $user->city}}</td></tr>
                            </table>
                            </div>
                        </div>
                   </div> 

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
                        
                        <div class="collapse" id="collapseAds">
                            <div class="card-body">
                            @if($user->ads->count())
                            <div class="list-group">
                                @foreach($ads as $ad)

                                    <a href="{{ route('ads.show',$ad->id )}}" class="list-group-item list-group-item-action flex-column align-items-start">
                                        <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">{{$ad->title}}</h5>
                                        <small class="text-muted">{{ $ad->created_at->diffForHumans() }}</small>
                                        </div>
                                        <p class="mb-1">{{ $ad->description}}</p>
                                    </a>
                                @endforeach

                                {{ $ads->onEachSide(1)->links() }}
                            </div>
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
                        
                        <div class="collapse" id="collapseEmails">
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
