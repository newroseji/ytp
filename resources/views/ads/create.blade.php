@extends('layouts.blog_tpl')
@section('breadcrumbs', Breadcrumbs::render('ads.create'))

@section('ext_css')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />

@endsection('ext_css')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Post an ad</div>

                <div class="card-body">


                    <form method="POST" 
                    enctype="multipart/form-data" 
                    action="{{ route('ads.store') }}" 
                    class="col-md-6">
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



                            <div class="form-group">
                                <label for="publish">Publish</label>

                                <div class="input-group date" id="publish" data-target-input="nearest">
                                    <input type="text" name="publish" required class="form-control datetimepicker-input" 
                                    value="{{ date('m/d/Y h:i A')}}"
                                    data-target="#publish"/>
                                    <div class="input-group-append" data-target="#publish" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="datetimepicker1">Expires</label>

                                <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                                    <input type="text" name="expires" required class="form-control datetimepicker-input" 
                                    value="{{ Carbon\Carbon::now()->addDay()->format('m/d/Y h:i A') }}"

                                    data-target="#datetimepicker1"/>
                                    <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>

                            </div>


                            <div class="form-group">
                                
                                <label for="pictures">Upload pictures</label>
                                <input id="pictures" multiple="multiple" name="image[]" type="file">
                                

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

    @section('ext_js')

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>

    <script type="text/javascript">
        $(function () {
            $('#datetimepicker1').datetimepicker();
        });
    </script>

    @endsection('ext_js')