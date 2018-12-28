@extends('layouts.blog_tpl')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header"><h5>{{ $ad->title }} - {{ $ad->price}} </h5>
                <span class="text-muted">{{ $ad->category }}</span>
                </div>

                <div class="card-body">

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>{!! $ad->description !!}
                    

                </div>

                <div class="card-footer">
                <a href="{{ URL::previous() }}" class="btn btn-info">Back</a>
                </div>


            </div>
        </div>
    </div>
</div>
@endsection