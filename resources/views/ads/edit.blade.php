@extends('layouts.blog_tpl')
@section('breadcrumbs', Breadcrumbs::render('ads.edit', $ad) )
@section('ext_css')
<link href="{{ asset('css/bootstrap.v4/bs-switch.css') }}" rel="stylesheet">
@endsection('ext_css')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-body">

                    @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                    @endif


                    @if($errors->count())
                        @foreach($errors as $error)
                        {{ $error}}
                        @endforeach
                    @endif
 
                    <form action="{{ route('ads.update', $ad->id) }}" 
                    class="col-md-8 col-md-offset-2"
                    method="POST"  role="form">
                    @method('PATCH')
                    @csrf

                        <div class="form-group" >
                            <label for="title">Title
                            </label>
                            <input id="title" class="form-control" type="hidden" name="user_id"
                            value="{{ $ad->user_id}}"
                            >
                            <input id="title" class="form-control" 
                            type="text" value="{{ $ad->title}}" name="title" placeholder="Ad title">
                            @if($errors->has('title'))
                                    
                                        {!! $errors->first('title') !!} 
                                   
                                @endif
                        </div>

                        
                            
                        <!-- Need Active switch -->
                        <div class="form-group">
                            <label for="active">Active</label>
                            <input type="text" id="active" name="active" class="form-control" value="{{ $ad->active}}">
                        </div>

                       

                        <div class="form-group">
                            <label for="descrption">Description</label>

                            <textarea id ="description" name="description" 
                            class="form-control" cols="50" rows="5">{!!$ad->description!!}</textarea>

                            @if($errors->has('description'))
                                    {!! $errors->first('description') !!} 
                                @endif
                        </div>

                        <div class="form-group">
                            <label for="category">Category</label>
                            <select name="category_id" class="form-control" id="category">
                                @foreach($ad_categories as $cat)
                                    <option value="{{$cat->id }}" {{ $ad->category_id==$cat->id ? 'selected' : '' }}>{!! $cat->name !!}
                                @endforeach
                            </select>

                            @if($errors->has('category_id'))
                                    {!! $errors->first('category_id') !!} 
                                @endif
                            
                        </div>

                        <div class="form-group">
                            <label for="price">Price (Rs)</label>
                            <input type="text" name ="price" id ="price" class="form-control" value="{{ $ad->price }}">
                            @if($errors->has('price'))
                                    {!! $errors->first('price') !!} 
                                @endif
                        </div>


                        <div class="form-group">
                        <input type="submit" class="form-control btn btn-primary btn-lg" 
                        value="Submit">
                        </div>

                        
                    
                    </form>    

                </div>

            </div>
        </div>
    </div>
</div>
@endsection