<section>
    <form method="post" action="{{ route('password.update') }}" class="row g-3 mt-1">
        @csrf
        @method('put')

        <div class="col-12">
            <label for="update_password_current_password" class="form-label fw-bold">Current Password</label>
            <input id="update_password_current_password" name="current_password" type="password" class="form-control" placeholder="••••••••">
            @if($errors->updatePassword->get('current_password'))
                <div class="text-danger small mt-1">{{ $errors->updatePassword->first('current_password') }}</div>
            @endif
        </div>

        <div class="col-12">
            <label for="update_password_password" class="form-label fw-bold">New Password</label>
            <input id="update_password_password" name="password" type="password" class="form-control" placeholder="••••••••">
            @if($errors->updatePassword->get('password'))
                <div class="text-danger small mt-1">{{ $errors->updatePassword->first('password') }}</div>
            @endif
        </div>

        <div class="col-12">
            <label for="update_password_password_confirmation" class="form-label fw-bold">Confirm New Password</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-control" placeholder="••••••••">
            @if($errors->updatePassword->get('password_confirmation'))
                <div class="text-danger small mt-1">{{ $errors->updatePassword->first('password_confirmation') }}</div>
            @endif
        </div>

        <div class="col-12 pt-2 d-flex align-items-center gap-3">
            <button type="submit" class="sakn-btn-gold px-4">{{ __('Update Password') }}</button>

            @if (session('status') === 'password-updated')
                <div class="text-success small fw-bold animate__animated animate__fadeIn">
                    <i class="bi bi-shield-check me-1"></i> {{ __('Password updated securely.') }}
                </div>
            @endif
        </div>
    </form>
</section>
