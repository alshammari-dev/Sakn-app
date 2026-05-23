<section>
    <div class="bg-light p-3 rounded-3 mb-4 border-start border-danger border-4">
        <p class="text-muted small mb-0">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please download any data you wish to retain before proceeding.') }}
        </p>
    </div>

    <button type="button" class="btn btn-outline-danger px-4 fw-bold" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
        {{ __('Delete My Account') }}
    </button>

    <!-- Bootstrap Modal for Deletion -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold text-danger">{{ __('Confirm Account Deletion') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')
                    <div class="modal-body py-4">
                        <p class="text-dark">{{ __('Are you sure you want to delete your account? This action cannot be undone.') }}</p>
                        
                        <div class="mt-3">
                            <label for="password" class="form-label fw-bold small text-muted text-uppercase">Enter your password to confirm</label>
                            <input id="password" name="password" type="password" class="form-control" placeholder="••••••••" required>
                            @if($errors->userDeletion->get('password'))
                                <div class="text-danger small mt-1">{{ $errors->userDeletion->first('password') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                        <button type="submit" class="btn btn-danger px-4">{{ __('Permanently Delete') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
