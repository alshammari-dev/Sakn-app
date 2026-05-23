<x-guest-layout>
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-4 text-center">
            <h4 class="fw-bold text-dark mb-1">Sign In</h4>
            <p class="text-muted small">Please enter your credentials to continue</p>
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

        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="form-label"><i class="bi bi-envelope-fill"></i> Email Address</label>
            <input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus placeholder="name@example.com">
        </div>

        <!-- Password -->
        <div class="mb-3">
            <div class="d-flex justify-content-between align-items-center">
                <label for="password" class="form-label"><i class="bi bi-lock-fill"></i> Password</label>
                @if (Route::has('password.request'))
                    <a class="small text-decoration-none mb-2 fw-bold" style="font-size: 0.75rem; color: var(--sakn-gold);" href="{{ route('password.request') }}">
                        Forgot?
                    </a>
                @endif
            </div>
            <input id="password" class="form-control" type="password" name="password" required placeholder="••••••••">
        </div>

        <!-- Remember Me -->
        <div class="mb-4">
            <div class="form-check">
                <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                <label for="remember_me" class="form-check-label small text-muted fw-bold">Stay Signed In</label>
            </div>
        </div>

        <button type="submit" class="btn-sakn-identity">
            Login
        </button>

        <div class="mt-4 text-center">
            <p class="text-muted small mb-0">New User? 
                <a href="{{ route('register') }}" class="fw-bold text-decoration-none" style="color: var(--sakn-green);">Create Account</a>
            </p>
        </div>
    </form>
</x-guest-layout>
