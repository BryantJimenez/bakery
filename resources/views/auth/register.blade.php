@extends('layouts.auth')

@section('title', 'User Register')

@section('content')

<div id="register">
    <aside>
        <figure>
            <a href="{{ route('home') }}">
                <img src="{{ asset('/web/img/logo_sticky.svg') }}" width="140" height="35" title="Logo" alt="Logo">
            </a>
        </figure>
        <form action="{{ route('register') }}" method="POST" id="formRegister">
            {{ csrf_field() }}

            @include('admin.partials.errors')

            <div class="form-group">
                <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" required placeholder="Name" value="{{ old('name') }}" minlength="2" maxlength="191">
                <i class="icon_pencil-edit"></i>
            </div>
            <div class="form-group">
                <input class="form-control @error('lastname') is-invalid @enderror" type="text" name="lastname" required placeholder="Last Name" value="{{ old('lastname') }}" minlength="2" maxlength="191">
                <i class="icon_pencil-edit"></i>
            </div>
            <div class="form-group">
                <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" required placeholder="Email" value="{{ old('email') }}" minlength="5" maxlength="191">
                <i class="icon_mail_alt"></i>
            </div>
            <div class="form-group">
                <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" required placeholder="Password" minlength="8" maxlength="40" id="password">
                <i class="icon_lock_alt"></i>
            </div>
            <div class="form-group">
                <input type="checkbox" name="terms" required id="terms-conditions">
                <label class="small" for="terms-conditions">I accept <a href="javascript:void(0);">terms and conditions</a></label>
            </div>
            <div id="pass-info" class="clearfix"></div>
            <button type="submit" class="btn_1 gradient full-width" action="register">Sign Up</button>
            <div class="text-center mt-2"><small>Do you already have an account? <strong><a href="{{ route('login') }}">Sign in</a></strong></small></div>
        </form>
        <div class="copy">© {{ date('Y') }} Tiendita</div>
    </aside>
</div>

<div class="modal fade" id="modal-terms" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Terms and Conditions</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="height: 70vh; overflow-y: scroll;">
                <div class="row">
                    <div class="col-12">
                        {{-- {!! $setting->terms !!} --}}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger rounded" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection