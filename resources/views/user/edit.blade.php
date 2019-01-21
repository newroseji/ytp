@extends('layouts.blog_tpl')
@section('breadcrumbs', Breadcrumbs::render('users.edit', $user) )
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

               


            <div class="card">
                <div class="card-header">Edit profile</div>

                <div class="card-body">


<form method="POST" action="{{ route('users.update', $user->id) }}" 
                class="mt-3">
                        @method('PATCH')
                        @csrf

                        <div class="form-group row">
                            <label for="firstname" class="col-md-2 col-form-label text-md-right">{{ __('Fullname') }}</label>

                            <div class="col-md-4">
                                <input id="firstname" type="text" 
                                
                                placeholder="Firstname"
                                class="form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}" 
                                name="firstname" value="{{ $user->firstname }}" required autofocus>

                                @if ($errors->has('firstname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('firstname') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-2">
                                <input id="middlename" type="text" 
                                
                                placeholder="Middlename"
                                class="form-control{{ $errors->has('middlename') ? ' is-invalid' : '' }}" 
                                name="middlename" value="{{ $user->middlename }}" >

                                @if ($errors->has('middlename'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('middlename') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-4">
                                <input id="lastname" type="text" 
                                value="{{ $user->lastname }}"
                                placeholder="Lastname"
                                class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}" 
                                name="lastname"  required >
                               

                                @if ($errors->has('lastname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-2 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <span class="input">{{ $user->email}}</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-2 col-form-label text-md-right">{{ __('Phone') }}</label>

                            <div class="col-md-4">
                                <input id="mobile" type="text" 
                                placeholder="Mobile"
                                value="{{ $user->mobile }}"
                                class="form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}" 
                                name="mobile" required>

                                @if ($errors->has('mobile'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-4">
                                <input id="phone" type="text" 
                                placeholder="Home Phone"
                                class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" 
                                value="{{ $user->phone }}"
                                name="phone">

                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>

                            
                        </div>

                        <div class="form-group row">
                            <label for="mobile" class="col-md-2 col-form-label text-md-right">{{ __('Address') }}</label>

                            <div class="col-md-3">
                                <input id="street" type="text" 
                                placeholder="Street address"
                                class="form-control{{ $errors->has('street') ? ' is-invalid' : '' }}" 
                                value="{{ $user->street }}"
                                name="street" required>

                                @if ($errors->has('street'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('street') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-3">
                                <input id="area" type="text" 
                                placeholder="Area"
                                class="form-control{{ $errors->has('area') ? ' is-invalid' : '' }}" name="area" 
                                value="{{ $user->area }}"
                                required>

                                @if ($errors->has('area'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('area') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-3">
                                <input id="city" type="text" 
                                placeholder="City"
                                class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" 
                                name="city"
                                value="{{ $user->city }}" 
                                required>

                                @if ($errors->has('city'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>

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