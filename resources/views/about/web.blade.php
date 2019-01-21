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
                    

                    <p>You might sometimes wonder how cool it would be if I can sell stuff that I do not want anymore but is in my posession for long! Or, you want to buy something that would be cheaper than the original price. Well, you have come to the right place.</p>
                    <p>We have made this portal where buyers and sellers can meet virtually to buy or sell stuff. We just do the intermediate job to make you happy. We hope you guys take full advantage of this convenience.</p>
                    <p>Remember, we do not take responsibility of the transactions. So, please make sure to be safe and sound through out the transaction.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection