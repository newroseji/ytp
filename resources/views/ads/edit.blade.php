@extends('layouts.blog_tpl')
@section('breadcrumbs', Breadcrumbs::render('ads.edit', $ad) )
@section('ext_css')
<link href="{{ asset('css/bootstrap.v4/bs-switch.css') }}" rel="stylesheet">


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />

@endsection('ext_css')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-body">

                    

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
                            <label for="deleted">Active</label>
                            <input type="text" id="deleted" name="deleted" class="form-control" value="{{ $ad->deleted}}">
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
                            <label for="datetimepicker1">Expires</label>
                            
                            <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                                <input type="text" name="expires" required class="form-control datetimepicker-input" 
                                 value="{{ $ad->expires }}"
                                data-target="#datetimepicker1"/>

                                <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>

                                @if($errors->has('expires'))
                                    {!! $errors->first('expires') !!} 
                                @endif
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="publish">Publish</label>
                            
                            <div class="input-group date" id="publish" data-target-input="nearest">
                                <input type="text" name="publish" required class="form-control datetimepicker-input" 
                                value="{{ $ad->publish }}"
                                data-target="#publish"/>
                                <div class="input-group-append" data-target="#publish" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                                @if($errors->has('publish'))
                                    {!! $errors->first('publish') !!} 
                                @endif
                            </div>

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

@section('ext_js')

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>

<script type="text/javascript">
            $(function () {
                $('#datetimepicker1').datetimepicker();
            });
        </script>

@endsection('ext_js')