@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card border-danger mt-5">
            <div class="card-header bg-danger text-white">404 - Page Not Found</div>
            <div class="card-body text-center">
                <h3 class="display-4 text-danger">Oops!</h3>
                <p class="lead">The page you are looking for does not exist.</p>
                <p>It might have been moved or deleted.</p>
                <a href="{{ url('/') }}" class="btn btn-primary mt-3">Go to Dashboard</a>
            </div>
        </div>
    </div>
</div>
@endsection
