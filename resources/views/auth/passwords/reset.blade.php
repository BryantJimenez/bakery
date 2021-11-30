@extends('layouts.auth')

@section('title', 'Reset Password')

@section('content')

<div id="register">
    <aside>
        <figure>
            <a href="{{ route('home') }}">
                <img src="{{ asset('/web/img/logo_sticky.svg') }}" width="140" height="35" title="Logo" alt="Logo">
            </a>
        </figure>
        <form action="{{ route('password.update') }}" method="POST" id="formReset">
            {{ csrf_field() }}

            @include('admin.partials.errors')

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group">
                <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" required placeholder="Email" autocomplete="email" autofocus value="{{ old('email') }}" minlength="5" maxlength="191">
                <i class="icon_mail_alt"></i>
            </div>
            <div class="form-group">
                <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" required placeholder="New Password" autocomplete="new-password" minlength="8" maxlength="40" id="password">
                <i class="icon_lock_alt"></i>
            </div>
            <div class="form-group">
                <input class="form-control @error('password') is-invalid @enderror" type="password" name="password_confirmation" required placeholder="Confirm Password" autocomplete="new-password" minlength="8" maxlength="40" id="password-confirm">
                <i class="icon_lock_alt"></i>
            </div>
            <div id="pass-info" class="clearfix"></div>
            <button type="submit" class="btn_1 gradient full-width" action="reset">Send</button>
            <div class="text-center mt-2"><small>Do you already have an account? <strong><a href="{{ route('login') }}">Sign in</a></strong></small></div>
        </form>
        <div class="copy">© {{ date('Y') }} Tiendita</div>
    </aside>
</div>

@endsection