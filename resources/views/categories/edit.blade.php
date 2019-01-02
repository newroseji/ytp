@extends('layouts.blog_tpl')
@section('breadcrumbs', Breadcrumbs::render('categories.edit',$category))
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Edit</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form 
                    method="POST" 
                    action="{{ route('categories.update', $category->id) }}" 
                    class="col-md-6">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" 
                            id="name" 
                            class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" 
                                name="name"
                                value="{{ $category->name }}" 
                            required 
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
                            class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" 
                                name="description"
                                
                            id="description" 
                           required
                            >{{ $category->description }}</textarea>
                            @if($errors->has('description'))
                                    {!! $errors->first('description') !!} 
                                @endif
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-5 offset-md-3">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection