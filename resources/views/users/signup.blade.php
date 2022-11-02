<x-layout>
    <x-slot:title>
        Sign Up
        </x-slot>

        <div class="container col-xl-10 col-xxl-8 px-4 py-5">
            <div class="row align-items-center g-lg-5 py-5">
                <div class="col-md-10 mx-auto col-lg-5">
                    <form method="POST" action="/signup" class="p-4 p-md-5 rounded-3 bg-dark">
                        @csrf
                        <div class="form-group mb-3 @error('username') has-validation @enderror">
                            <div class="form-floating @error('username') is-invalid @enderror">
                                <input type="text" class="form-control @error('username') is-invalid @enderror"
                                    placeholder="johndoe123" name="username" value="{{ old('username') }}">
                                <label for="username">Username</label>
                            </div>
                            @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
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
                        <div class="form-group mb-3 @error('password') has-validation @enderror">
                            <div class="form-floating mb-3 @error('password') is-invalid @enderror">
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Password" name="password">
                                <label for="password">Password</label>
                            </div>
                            <div class="form-floating @error('password') is-invalid @enderror">
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Password" name="password_confirmation">
                                <label for="password_confirmation">Confirm Password</label>
                            </div>
                            @error('password')
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

                        <button class="w-100 btn btn-lg btn-primary" type="submit">Sign up</button>
                        <hr class="my-4">
                        <small class="text-muted">Already have an account? <a href="/login">Log In!</a></small>
                    </form>
                </div>
            </div>
        </div>

</x-layout>
