@extends('layouts.app')

@section('content')
<div class="container-fluid p-0 overflow-hidden">
    <div class="row g-0" style="min-height: calc(100vh - 56px);">
        <!-- Left Side: Illustration -->
        <div class="col-lg-6 d-none d-lg-block position-relative">
            <div class="h-100 w-100" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div class="position-absolute top-50 start-50 translate-middle text-center text-white p-4">
                    <img src="https://images.unsplash.com/photo-1484417894907-623942c8ee29?q=80&w=1932&auto=format&fit=crop" 
                         alt="Task Management" 
                         class="img-fluid rounded shadow-lg mb-4" 
                         style="max-width: 80%; transform: rotate(-2deg);">
                    <h2 class="fw-bold">Manage Your Tasks Efficiently</h2>
                    <p class="lead">Join thousands of professionals organizing their workflow with ease.</p>
                </div>
            </div>
        </div>

        <!-- Right Side: Login Form -->
        <div class="col-lg-6 d-flex align-items-center justify-content-center bg-white p-4 p-md-5">
            <div class="w-100" style="max-width: 400px;">
                <div class="text-center mb-4">
                    <h3 class="fw-bold">Welcome Back</h3>
                    <p class="text-muted">Please enter your details to login</p>
                </div>

                <form method="POST" action="{{ route('login') }}" id="loginForm" novalidate>
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Email Address</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="bi bi-envelope"></i></span>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control bg-light border-start-0" placeholder="name@example.com" required autofocus>
                        </div>
                        @error('email') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="bi bi-lock"></i></span>
                            <input id="password" type="password" name="password" class="form-control bg-light border-start-0" placeholder="••••••••" required>
                        </div>
                        @error('password') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                            <label class="form-check-label small text-muted" for="remember_me">Remember me</label>
                        </div>
                    </div>

                    <div class="d-grid mb-4">
                        <button type="submit" class="btn btn-primary btn-lg shadow-sm">Sign In</button>
                    </div>

                    <div class="text-center">
                        <span class="text-muted small">Don't have an account? </span>
                        <a class="text-primary small fw-bold text-decoration-none" href="{{ route('register') }}">Create an account</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
