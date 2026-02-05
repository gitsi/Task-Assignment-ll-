@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card border-danger mt-5">
            <div class="card-header bg-danger text-white">500 - Server Error</div>
            <div class="card-body text-center">
                <h3 class="display-4 text-danger">Error</h3>
                <p class="lead">Something went wrong on our servers.</p>
                <a href="{{ url('/') }}" class="btn btn-primary mt-3">Go to Dashboard</a>
            </div>
        </div>
    </div>
</div>
@endsection
