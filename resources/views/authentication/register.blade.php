@extends('script')
@section('body')
    <section class="signup">
        <div class="container">
            <div class="signin-header mt-5">
                <img src="{{ asset('images/polalogo.png') }}" alt="pola logo" style="width: 50%;margin-left: 25%;">
                <h1 class="form-title text-center">Bantuin Kamu Kelola Proyek Freelance-mu!</h1>
            </div>
            <div class="signup-content  mb-5 p-0">
                <div class="signup-form">
                    <h2 class="form-title">Sign up</h2>
                    <form class="register-form" action="{{ route('register-proses') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="text" name="fullname" id="fullname" placeholder="Your Name" required />
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email"><i class="zmdi zmdi-email"></i></label>
                            <input class="@error('email')is-invalid @enderror" type="email" name="email" id="email"
                                placeholder="Your Email" required />
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="password" id="pass" placeholder="Password" required />
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                            <input type="password" name="confirmPassword" id="confirmPassword"
                                placeholder="Repeat your password" required />
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="form-group form-button">
                            <input type="submit" name="signup" id="signup" class="form-submit" value="Register" />
                        </div>
                    </form>
                    <div class="text-secondary mt-3">
                        Already have an account? <a href="{{ route('login') }}" tabindex="-1">Sign in</a>
                    </div>
                </div>
                <div class="signup-image">
                    <figure><img src="images/signup-image.jpg" alt="sing up image"></figure>
                </div>
            </div>
        </div>
    </section>
@endsection
