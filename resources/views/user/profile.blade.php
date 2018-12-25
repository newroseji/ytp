@extends('layouts.blog_tpl')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Logged in Profile: {{ Auth::user()->name }} </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

<form name="emailForm" role="form" method="POST" action="{{ url('send/email') }}">
@csrf
<label for="email">Email</label>
<input type="email" id="email" name="txt_email" autofocus placeholder="Email address only">

<input type="submit" value="Send a test email" class="btn btn-primary btn-sm d-inline">
<input type="reset" value="Clear" class="btn btn-sm btn-danger btn-o">
</form>
                    

                    
                </div>

                
            </div>
        </div>
    </div>
</div>
@endsection
