<x-layout>
    <x-slot:title>
        Forgot Password
        </x-slot>

        <div class="container col-xl-10 col-xxl-8 px-4 py-5">
            <div class="row align-items-center g-lg-5 py-5">
                <div class="col-md-10 mx-auto col-lg-5">
                    <form method="POST" action="/forgot-password" class="p-4 p-md-5 rounded-3 bg-dark">
                        @csrf
                        <div class="form-group mb-3 @error('email') has-validation @enderror">
                            <div class="form-floating @error('email') is-invalid @enderror">
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    placeholder="name@example.com" name="email" value="{{ old('email') }}">
                                <label for="email">Email</label>
                            </div>
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3 @error('g-recaptcha-response') has-validation @enderror">
                            <div class="form-floating @error('g-recaptcha-response') is-invalid @enderror">
                                @recaptcha_field
                            </div>
                            @error('g-recaptcha-response')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button class="w-100 btn btn-lg btn-primary" type="submit">Confirm</button>
                        <hr class="my-4">
                        <small class="text-muted d-block">Don't have account yet? <a href="/signup">Sign up!</a></small>
                    </form>
                </div>
            </div>
        </div>

</x-layout>
