<x-layout>
    <x-slot:title>
        Log In
        </x-slot>

        <div class="container col-xl-10 col-xxl-8 px-4 py-5">
            <div class="row align-items-center g-lg-5 py-5">
                <div class="col-md-10 mx-auto col-lg-5">
                    <form method="POST" action="/login" class="p-4 p-md-5 rounded-3 bg-dark">
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

                        <div class="form-group mb-3 @error('password') has-validation @enderror">
                            <div class="form-floating mb-3 @error('password') is-invalid @enderror">
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Password" name="password">
                                <label for="password">Password</label>
                            </div>
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" value="1" name="remember_me"
                                    id="remember_me">
                                <label for="remember_me" class="form-check-label">Remember Me</label>
                            </div>
                        </div>

                        <button class="w-100 btn btn-lg btn-primary" type="submit">Log in</button>
                        <hr class="my-4">
                        <small class="text-muted">Don't have account yet? <a href="/signup">Sign up!</a></small>
                    </form>
                </div>
            </div>
        </div>

</x-layout>
