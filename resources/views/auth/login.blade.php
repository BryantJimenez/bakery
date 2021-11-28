@extends('layouts.auth')

@section('title', 'Login')

@section('content')

<section class="login-block">
  <div class="container">
    <div class="row">
      <div class="col-lg-4 col-md-5 col-12 login-sec">
        <h2 class="text-center">Login</h2>
        <form class="login-form" action="{{ route('login') }}" method="POST" id="formLogin">
          {{ csrf_field() }}

          @include('admin.partials.errors')

          <div class="form-group">
            <label for="email" class="text-uppercase">EMAIL</label>
            <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" required placeholder="{{ 'email@gmail.com' }}" value="{{ old('email') }}" minlength="5" maxlength="191">
          </div>

          <div class="form-group">
            <label for="password" class="text-uppercase">PASSWORD</label>
            <input id="password" name="password" type="password" class="form-control @error('email') is-invalid @enderror" required placeholder="********" minlength="8" maxlength="40">
          </div>

          <div class="form-group">
            <a href="{{ route('password.request') }}">I forgot my password</a>
          </div>

          <div class="form-group">
            <button type="submit" class="btn btn-login" action="login">Login</button>
          </div>

          <div class="form-group">
            You do not have an account? <a href="{{ route('register') }}"><b>Sign up</b></a>
          </div>
        </form>
      </div>

      <div class="col-lg-8 col-md-7 col-12 banner-sec">
        <img class="d-block img-fluid h-100 w-100" src="{{ asset("/auth/image.jpg") }}" alt="Image" title="Image">
      </div>
    </div>
  </div>
</section>

@endsection