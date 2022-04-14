@extends('layouts.auth')

@section('title', trans('auth.login.title'))

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
        <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" required placeholder="@lang('form.email.label')" value="{{ old('email') }}" minlength="5" maxlength="191">
        <i class="icon_mail_alt"></i>
      </div>
      <div class="form-group">
        <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" required placeholder="@lang('form.password.label')" minlength="8" maxlength="40" id="password">
        <i class="icon_lock_alt"></i>
      </div>
      <div id="pass-info" class="clearfix"></div>
      <button type="submit" class="btn_1 gradient full-width" action="login">@lang('auth.login.button')</button>
      <div class="text-center mt-2"><small>@lang('auth.login.password.text') <strong><a href="{{ route('password.request') }}">@lang('auth.login.password.button')</a></strong></small></div>
      <div class="text-center mt-2"><small>@lang('auth.login.register.text') <strong><a href="{{ route('register') }}">@lang('auth.login.register.button')</a></strong></small></div>
    </form>
    <div class="copy">© {{ date('Y') }} @lang('admin.name')</div>
  </aside>
</div>

@endsection