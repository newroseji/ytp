@extends('layouts.blog_tpl')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Profile</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a 
                href="{{ url('send/email') }}" 
                class="btn btn-primary btn-sm d-block">Send a test email</a>

                    {{ Auth::user()->name }}, you are logged in!
                </div>

                
            </div>
        </div>
    </div>
</div>
@endsection
