<x-guest-layout>
    <div class="mb-4 text-center">
        <h4 class="fw-bold text-dark mb-1">Recover Password</h4>
        <p class="text-muted small">
            {{ __('Forgot your password? No problem. Enter your email and we will send you a reset link.') }}
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

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

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-4">
            <label for="email" class="form-label"><i class="bi bi-envelope-fill"></i> Email Address</label>
            <input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus placeholder="name@example.com">
        </div>

        <button type="submit" class="btn-sakn-identity">
            Send Reset Link
        </button>

        <div class="mt-4 text-center">
            <a href="{{ route('login') }}" class="fw-bold text-decoration-none small" style="color: var(--sakn-gold);">
                <i class="bi bi-arrow-left me-1"></i> Back to Login
            </a>
        </div>
    </form>
</x-guest-layout>
