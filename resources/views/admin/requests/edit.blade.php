@extends('layouts.app')

@section('content')
    <div class="container">
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        @if($errors->any())
            <h4>{{$errors->first()}}</h4>
        @endif
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header row">
                    <h3 class="col">{{ __('Edit request #') . $req->id }}</h3>
                    <a href="{{url('home')}}" class="btn btn-outline-danger float-end col-1">Home</a>
                </div>
                <div class="card-body">
                    <form name="request-message" id="request-message" method="post" action="{{url('edit-request')}}">
                        @csrf
                        <input type="hidden" value="{{$req->id}}" name="req_id">
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $req->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('E-Mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $req->email }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="phone" class="col-md-4 col-form-label text-md-end">{{ __('Phone number') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{$req->phone}}" required>

                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="message" class="col-md-4 col-form-label text-md-end">{{ __('Message') }}</label>
                            <div class="col-md-6">
                                <textarea class="form-control" name="message">@if(!empty($req->message)){{$req->message}}@endif</textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <button type="submit" form="request-message" class="btn btn-primary btn-lg active form-control">Submit</button>
                </div>
            </div>
        </div>
    </div>
@endsection
