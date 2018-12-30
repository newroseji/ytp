@extends('layouts.blog_tpl')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Post an ad</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('ads.store') }}" class="col-md-6">
                        @csrf
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" id="title" name="title" required class="form-control"
                            placeholder="Title of the Ad">
                            
                                @if($errors->has('title'))
                                    
                                        {!! $errors->first('title') !!} 
                                   
                                @endif
                            
                        </div>

                        <div class="form-group">
                            
                            <textarea  
                            cols="50" 
                            rows="5" 
                            class="form-control" 
                            id="description" 
                            name="description" required
                            >Default text here</textarea>
                            @if($errors->has('description'))
                                    {!! $errors->first('description') !!} 
                                @endif
                        </div>

                        <div class="form-group">
                            <label for="category">Category</label>
                            <select class="form-control" name="category_id" id="category" required>
                                <option value=""></option>
                                @foreach($ad_categories as $cat)
                                    <option value="{{$cat->id }}" >{!! $cat->name !!}
                                @endforeach
                            </select>

                            @if($errors->has('category_id'))
                                    {!! $errors->first('category_id') !!} 
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
</div>
@endsection