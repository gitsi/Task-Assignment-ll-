@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card border-warning mt-5">
            <div class="card-header bg-warning text-dark">405 - Method Not Allowed</div>
            <div class="card-body text-center">
                <h3 class="display-4 text-warning">Warning</h3>
                <p class="lead">The action you are trying to perform is not allowed this way (e.g. visiting a logout link directly).</p>
                <a href="{{ url('/') }}" class="btn btn-primary mt-3">Go to Dashboard</a>
            </div>
        </div>
    </div>
</div>
@endsection
