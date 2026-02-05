@extends('layouts.app')

@section('content')
<div class="container-fluid p-0 overflow-hidden">
    <div class="row g-0" style="min-height: calc(100vh - 56px);">
        <!-- Left Side: Illustration (Mirroring Login for consistency) -->
        <div class="col-lg-6 d-none d-lg-block position-relative">
            <div class="h-100 w-100" style="background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);">
                <div class="position-absolute top-50 start-50 translate-middle text-center text-white p-4">
                    <img src="https://images.unsplash.com/photo-1540350394557-8d14678e7f91?q=80&w=2032&auto=format&fit=crop" 
                         alt="Get Organized" 
                         class="img-fluid rounded shadow-lg mb-4" 
                         style="max-width: 80%; transform: rotate(2deg);">
                    <h2 class="fw-bold">Start Your Journey</h2>
                    <p class="lead">Create an account to begin tracking your projects and tasks effectively.</p>
                </div>
            </div>
        </div>

        <!-- Right Side: Register Form -->
        <div class="col-lg-6 d-flex align-items-center justify-content-center bg-white p-4 p-md-5">
            <div class="w-100" style="max-width: 400px;">
                <div class="text-center mb-4">
                    <h3 class="fw-bold">Create Account</h3>
                    <p class="text-muted">Fill in your details to get started</p>
                </div>

                <form method="POST" action="{{ route('register') }}" id="registerForm" novalidate>
                    @csrf

                    <!-- Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Full Name</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="bi bi-person"></i></span>
                            <input id="name" type="text" name="name" value="{{ old('name') }}" class="form-control bg-light border-start-0" placeholder="John Doe" required autofocus>
                        </div>
                        @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <!-- Email Address -->
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Email Address</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="bi bi-envelope"></i></span>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control bg-light border-start-0" placeholder="name@example.com" required>
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

                    <!-- Confirm Password -->
                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label fw-semibold">Confirm Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="bi bi-shield-lock"></i></span>
                            <input id="password_confirmation" type="password" name="password_confirmation" class="form-control bg-light border-start-0" placeholder="••••••••" required>
                        </div>
                    </div>

                    <div class="d-grid mb-4">
                        <button type="submit" class="btn btn-primary btn-lg shadow-sm">Create Account</button>
                    </div>

                    <div class="text-center">
                        <span class="text-muted small">Already have an account? </span>
                        <a class="text-primary small fw-bold text-decoration-none" href="{{ route('login') }}">Sign In</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
