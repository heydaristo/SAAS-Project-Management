@extends('script')
@section('body')
<script src="./dist/js/demo-theme.min.js?1695847769"></script>
<div class="page page-center">
  <div class="container container-tight py-4">
    <form class="card card-md" action="{{route('register-proses')}}" method="POST" >
      @csrf
      <div class="card-body">
        <h2 class="card-title text-center mb-4">Create new account</h2>

        <div class="mb-3">
          <label class="form-label">Full Name</label>
          <input type="text" id="fullname" class="form-control" name="fullname" @error('fullname')is-invalid @enderror" placeholder="Enter name" value="{{ old('fullname') }}" required>
        @error('fullname')
          <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
        </div>

        <div class="mb-3">
          <label class="form-label">Email address</label>
          <input type="email" class="form-control  @error('email')is-invalid @enderror"  name="email" placeholder="your@email.com" autocomplete="off" required value="{{ old('email')}}">
                @error('email')
                    <div class="invalid-feedback">
                      {{ $message }}
                  </div>
                @enderror
        </div>

        <div class="mb-3">
          <label class="form-label">Password</label>
          <div class="input-group input-group-flat">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" autocomplete="off"  required>
            <span class="input-group-text password-toggle">
              <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip" onclick="togglePassword('password')"><!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                <svg xmlns="http://www.w3.org/2000/svg" id="eye-icon" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
              </a>
            </span>
          </div>
          @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
          <label class="form-label">Confirm Password</label>
          <div class="input-group input-group-flat">
            <input type="password" class="form-control" id="confirmPassword" @error('confirmPassword')is-invalid @enderror" name="confirmPassword" placeholder="Confirm Password"  autocomplete="off" required>
            <span class="input-group-text">
              <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip" onclick="togglePassword('confirmPassword')"> <svg xmlns="http://www.w3.org/2000/svg" id="eye-icon-confirm" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
              </a>
            </span>
          </div>
     @error('confirmPassword')
          <div class="invalid-feedback">{{ $message }}</div>
      @enderror
        </div>
        <div class="form-footer">
          <button type="submit" class="btn btn-primary w-100">Create new account</button>
        </div>
      </div>
    </form>
    <div class="text-center text-secondary mt-3">
      Already have account? <a href="{{ route('login') }}" tabindex="-1">Sign in</a>
    </div>
  </div>
</div>

@endsection