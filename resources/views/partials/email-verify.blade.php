@auth
@unless(auth()->user()->hasVerifiedEmail())
<div class="container">
    <div class="row">
        <div class="col">
            <div class="alert alert-dismissible alert-success mb-4">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                A verification link has been sent to your email. Please open the link to complete your registration.
            </div>
        </div>
    </div>
</div>
@endunless
@endauth
