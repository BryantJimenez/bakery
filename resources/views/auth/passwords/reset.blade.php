@extends('layouts.auth')

@section('title', trans('auth.reset.title'))

@section('content')

<div id="register">
    <aside>
        <figure>
            <a href="{{ LaravelLocalization::getLocalizedURL(app()->getLocale(), route('home'), [], true) }}" hreflang="{{ app()->getLocale() }}">
                <img src="{{ asset('/web/img/logo_sticky.svg') }}" width="140" height="35" title="Logo" alt="Logo">
            </a>
        </figure>
        <form action="{{ route('password.update') }}" method="POST" id="formReset">
            {{ csrf_field() }}

            @include('admin.partials.errors')

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group">
                <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" required placeholder="@lang('form.email.label')" autocomplete="email" autofocus value="{{ old('email') }}" minlength="5" maxlength="191">
                <i class="icon_mail_alt"></i>
            </div>
            <div class="form-group">
                <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" required placeholder="@lang('form.password.new')" autocomplete="new-password" minlength="8" maxlength="40" id="password">
                <i class="icon_lock_alt"></i>
            </div>
            <div class="form-group">
                <input class="form-control @error('password') is-invalid @enderror" type="password" name="password_confirmation" required placeholder="@lang('form.password confirmation.label')" autocomplete="new-password" minlength="8" maxlength="40" id="password-confirm">
                <i class="icon_lock_alt"></i>
            </div>
            <div id="pass-info" class="clearfix"></div>
            <button type="submit" class="btn_1 gradient full-width" action="reset">@lang('auth.reset.button')</button>
            <div class="text-center mt-2"><small>@lang('auth.reset.login.text') <strong><a href="{{ LaravelLocalization::getLocalizedURL(app()->getLocale(), route('login'), [], true) }}" hreflang="{{ app()->getLocale() }}">@lang('auth.reset.login.button')</a></strong></small></div>
        </form>
        <div class="copy">© {{ date('Y') }} @lang('admin.name')</div>
    </aside>
</div>

@endsection