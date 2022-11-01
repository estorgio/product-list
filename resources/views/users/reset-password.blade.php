<x-layout>
    <x-slot:title>
        Reset Password
        </x-slot>

        <div class="container col-xl-10 col-xxl-8 px-4 py-5">
            <div class="row align-items-center g-lg-5 py-5">
                <div class="col-md-10 mx-auto col-lg-5">
                    <form method="POST" action="/reset-password" class="p-4 p-md-5 rounded-3 bg-dark">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <input type="hidden" name="email" value="{{ $email }}">

                        <div class="form-group mb-3 @error('password') has-validation @enderror">
                            <div class="form-floating mb-3 @error('password') is-invalid @enderror">
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Password" name="password" autofocus>
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

                        <button class="w-100 btn btn-lg btn-primary" type="submit">Reset Password</button>
                        <hr class="my-4">
                        <small class="text-muted">Already have an account? <a href="/login">Log In!</a></small>
                    </form>
                </div>
            </div>
        </div>

</x-layout>
