@extends('layouts.app')

@section('content')
<div class="container">
    @if(Auth::user()->is_admin)
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        @if($errors->any())
            <h4>{{$errors->first()}}</h4>
        @endif
        <div class="row justify-content-center">
            <h1>Admin dashboard</h1>
            <hr>
        </div>
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header row">
                    <h3 class="col">{{ __('Requests') }}</h3>
                    <a href="{{url('add-request')}}" class="btn btn-success float-end col-1">Add new</a>
                </div>
                <div class="card-body">
                    @foreach($listRequests as $req)
                        <h4 class="form-label"><b>User #</b>{{$req->user_id}} left this request:</h4>
                        <ul class="list-group">
                            <ui class="list-group-item"><b>Name:</b> {{$req['name'] . ''}} </ui>
                            <ui class="list-group-item"><b>Email:</b> {{$req['email']}} </ui>
                            <ui class="list-group-item"><b>Phone:</b> {{$req['phone']}} </ui>
                            <ui class="list-group-item"><b>Message:</b>
                                @if (!empty($req['message']))
                                    {{$req['message']}}
                                @endif
                            </ui>
                        </ul>
                    <br>
                    <div class="row">
                        <div class="col-1">
                            <a href="{{url('delete-request/' . $req->id)}}" class="btn btn-danger">Delete</a>
                        </div>
                        <div class="col-1">
                            <a href="{{url('update-request/' . $req->id)}}" class="btn btn-outline-warning">Update</a>
                        </div>
                    </div>
                    <hr>
                    @endforeach
                </div>
            </div>
        </div>
    @else
    <div class="row justify-content-center">
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        @if($errors->any())
            <h4>{{$errors->first()}}</h4>
        @endif
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('New request') }}</div>
                <div class="card-body">
                    <form name="request-message" id="request-message" method="post" action="{{url('send-request')}}">
                        @csrf
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

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
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" required>

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
                                <textarea class="form-control" name="message"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <button type="submit" form="request-message" class="btn btn-primary btn-lg active form-control">Submit</button>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Your requests') }}</div>
                <div class="card-body">
                    @foreach($listRequests as $req)
                        <ul class="list-group">
                            <ui class="list-group-item"><b>Name:</b> {{$req['name'] . ''}} </ui>
                            <ui class="list-group-item"><b>Email:</b> {{$req['email']}} </ui>
                            <ui class="list-group-item"><b>Phone:</b> {{$req['phone']}} </ui>
                            <ui class="list-group-item"><b>Message:</b>
                            @if (!empty($req['message']))
                                {{$req['message']}}
                            @endif
                            </ui>
                        </ul>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
