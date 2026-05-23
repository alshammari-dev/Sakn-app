<section>
    <form method="post" action="{{ route('profile.update') }}" class="row g-3 mt-1">
        @csrf
        @method('patch')

        <div class="col-12">
            <label for="name" class="form-label fw-bold">Full Name</label>
            <input id="name" name="name" type="text" class="form-control" value="{{ old('name', $user->name) }}" required autofocus>
            @if($errors->get('name'))
                <div class="text-danger small mt-1">{{ $errors->first('name') }}</div>
            @endif
        </div>

        <div class="col-12">
            <label for="email" class="form-label fw-bold">Email Address</label>
            <input id="email" name="email" type="email" class="form-control" value="{{ old('email', $user->email) }}" required>
            @if($errors->get('email'))
                <div class="text-danger small mt-1">{{ $errors->first('email') }}</div>
            @endif

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2 bg-light p-3 rounded">
                    <p class="text-sm text-dark mb-0">
                        {{ __('Your email address is unverified.') }}
                        <button form="send-verification" class="btn btn-link btn-sm p-0 text-decoration-none">
                            {{ __('Click here to re-send verification.') }}
                        </button>
                    </p>
                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-success small fw-bold">
                            {{ __('A new verification link has been sent.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="col-12 pt-2 d-flex align-items-center gap-3">
            <button type="submit" class="sakn-btn-gold px-4">{{ __('Save Changes') }}</button>

            @if (session('status') === 'profile-updated')
                <div class="text-success small fw-bold animate__animated animate__fadeIn">
                    <i class="bi bi-check-circle me-1"></i> {{ __('Changes saved successfully.') }}
                </div>
            @endif
        </div>
    </form>
</section>
