@extends('layouts.auth')

@section('title', 'Iniciar Sesión')

@section('content')

<div id="register">
  <aside>
    <figure>
      <a href="{{ route('home') }}">
        <img src="{{ asset('/web/img/logo_sticky.svg') }}" width="140" height="35" title="Logo" alt="Logo">
      </a>
    </figure>
    <form action="{{ route('login') }}" method="POST" id="formLogin">
      {{ csrf_field() }}

      @include('admin.partials.errors')

      <div class="form-group">
        <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" required placeholder="Email" value="{{ old('email') }}" minlength="5" maxlength="191">
        <i class="icon_mail_alt"></i>
      </div>
      <div class="form-group">
        <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" required placeholder="Contraseña" minlength="8" maxlength="40" id="password">
        <i class="icon_lock_alt"></i>
      </div>
      <div id="pass-info" class="clearfix"></div>
      <button type="submit" class="btn_1 gradient full-width" action="login">Ingresar</button>
      <div class="text-center mt-2"><small>¿Olvidaste tu contraseña? <strong><a href="{{ route('password.request') }}">Recuperar</a></strong></small></div>
      <div class="text-center mt-2"><small>¿No tienes cuenta? <strong><a href="{{ route('register') }}">Registrate</a></strong></small></div>
    </form>
    <div class="copy">© {{ date('Y') }} Tiendita</div>
  </aside>
</div>

@endsection