@extends('layouts.blog_tpl')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
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
                <div class="card-header">About the Website</div>

                <div class="card-body">
                    

                    This website is built with the help of Laravel framework.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection