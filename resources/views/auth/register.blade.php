<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-4 text-center">
            <h4 class="fw-bold text-dark mb-1">Create Account</h4>
            <p class="text-muted small">Join our premium network today</p>
        </div>

        @if ($errors->any())
            <div class="alert-error">
                <i class="bi bi-exclamation-circle me-2"></i>
                <ul class="mb-0 list-unstyled d-inline">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Name -->
        <div class="mb-3">
            <label for="name" class="form-label"><i class="bi bi-person-fill"></i> Full Name</label>
            <input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus placeholder="John Doe">
        </div>

        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="form-label"><i class="bi bi-envelope-fill"></i> Email Address</label>
            <input id="email" class="form-control" type="email" name="email" :value="old('email')" required placeholder="name@example.com">
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label"><i class="bi bi-lock-fill"></i> Password</label>
            <input id="password" class="form-control" type="password" name="password" required placeholder="••••••••">
        </div>

        <!-- Confirm Password -->
        <div class="mb-4">
            <label for="password_confirmation" class="form-label"><i class="bi bi-check-circle-fill"></i> Confirm Password</label>
            <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required placeholder="••••••••">
        </div>

        <button type="submit" class="btn-sakn-identity">
            Register Account
        </button>

        <div class="mt-4 text-center">
            <p class="text-muted small mb-0">Already have an account? 
                <a href="{{ route('login') }}" class="fw-bold text-decoration-none" style="color: #BC9355;">Sign In</a>
            </p>
        </div>
    </form>
</x-guest-layout>
