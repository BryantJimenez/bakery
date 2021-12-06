@extends('layouts.auth')

@section('title', 'Recuperar Contraseña')

@section('content')

<div id="register">
  <aside>
    <figure>
      <a href="{{ route('home') }}">
        <img src="{{ asset('/web/img/logo_sticky.svg') }}" width="140" height="35" title="Logo" alt="Logo">
      </a>
    </figure>
    <form action="{{ route('password.email') }}" method="POST" id="formRecovery">
      {{ csrf_field() }}

      @include('admin.partials.errors')

      <div class="form-group">
        <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" required placeholder="Email"  autocomplete="email" autofocus value="{{ old('email') }}" minlength="5" maxlength="191">
        <i class="icon_mail_alt"></i>
      </div>
      <div id="pass-info" class="clearfix"></div>
      <button type="submit" class="btn_1 gradient full-width" action="recovery">Enviar</button>
      <div class="text-center mt-2"><small>¿No tienes cuenta? <strong><a href="{{ route('register') }}">Regístrate</a></strong></small></div>
    </form>
    <div class="copy">© {{ date('Y') }} Tiendita</div>
  </aside>
</div>

@endsection