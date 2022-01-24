@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('New request') }}</div>
                <div class="card-body">
                    <label for="message">Write a message or question here</label>
                    <br>
                    <input type="text" class="form-control" name="message">
                </div>
                <div class="card-footer">
                    <a href="#" class="btn-success">Send request</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Your requests') }}</div>
                <div class="card-body">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
