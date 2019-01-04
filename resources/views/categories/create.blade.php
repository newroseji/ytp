@extends('layouts.blog_tpl')

@section('breadcrumbs', Breadcrumbs::render('categories.create'))
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Create a category</div>

                <div class="card-body">
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

                    <form 
                    method="POST" 
                    action="{{ route('categories.store') }}" 
                    class="col-md-6">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" required class="form-control"
                            placeholder="Name of the Category">
                            
                                @if($errors->has('name'))
                                    
                                        {!! $errors->first('name') !!} 
                                   
                                @endif
                            
                        </div>

                        <div class="form-group">
                        <label for="description">Description</label>
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
                        <div class="d-block">
                            <input type="submit" value="Create" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection