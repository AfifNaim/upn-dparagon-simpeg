@extends('layouts.skeleton')
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              <h4 class="mt-4">Sistem Manajemen Pegawai</h4>
            </div>

            <div class="card card-primary">
              <div class="card-header"><h4>Login</h4></div>
              <div class="card-body">
                @include('partials.message')
                <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate="">
                @csrf
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
                    @error('email')
                    <div class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                  </div>

                  <div class="form-group">
                    <div class="d-block">
                    	<label for="password" class="control-label">Password</label>
                    </div>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                    @error('password')
                    <div class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                  </div>

                  <div class="form-group">
                    <div class="from-check">
                      <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                      <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
                    </div>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                    {{ __('LOGIN') }}
                    </button>
                    @if (Illuminate\Support\Facades\Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                    </a>
                    @endif
                  </div>

                </form></div>
            </div>
            <div class="simple-footer">
              Copyright &copy; Royal D'Paragon {{ date('Y') }}
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>


