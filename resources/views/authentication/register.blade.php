@extends('script')
@section('body')
<script src="./dist/js/demo-theme.min.js?1695847769"></script>

<section class="signup">
  <div class="container">
      <div class="signup-content">
          <div class="signup-form">
              <h2 class="form-title">Sign up</h2>
              <form class="register-form" action="{{route('register-proses')}}" method="POST" >
                @csrf
                  <div class="form-group">
                      <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                      <input type="text" name="fullname" id="name" placeholder="Your Name" required/>
                      @error('fullname')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                  </div>
                  <div class="form-group">
                      <label for="email"><i class="zmdi zmdi-email"></i></label>
                      <input class="@error('email')is-invalid @enderror" type="email" name="email" id="email" placeholder="Your Email" required/>
                      @error('email')
                      <div class="invalid-feedback">
                      {{ $message }}
                      </div>
                      @enderror
                  </div>
                  <div class="form-group">
                      <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                      <input type="password" name="password" id="pass" placeholder="Password" required/>
                      @error('password')
                      <div class="invalid-feedback">
                      {{ $message }}
                      </div>
                      @enderror
                  </div>
                  <div class="form-group">
                      <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                      <input type="password" name="confirmPassword" id="confirmPassword" placeholder="Repeat your password" required/>
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
                  {{-- <div class="form-group">
                      <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                      <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                  </div> --}}
                  <div class="form-group form-button">
                      <input type="submit" name="signup" id="signup" class="form-submit" value="Register"/>
                  </div>
              </form>
              <div class="text-secondary mt-3">
                Already have account? <a href="{{ route('login') }}" tabindex="-1">Sign in</a>
              </div>
          </div>
          <div class="signup-image">
              <figure><img src="images/signup-image.jpg" alt="sing up image"></figure>
          </div>
      </div>
  </div>
</section>
@endsection