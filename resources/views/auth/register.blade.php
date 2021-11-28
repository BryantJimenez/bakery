@extends('layouts.auth')

@section('title', 'User Register')

@section('content')

<section class="login-block">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-5 col-12 login-sec">
                <h2 class="text-center">User Register</h2>
                <form class="login-form" action="{{ route('register') }}" method="POST" id="formRegister">
                    {{ csrf_field() }}

                    @include('admin.partials.errors')

                    <div class="row">
                        <div class="form-group col-lg-6 col-md-6 col-12">
                            <label for="name" class="text-uppercase">NAME</label>
                            <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" required placeholder="Name" value="{{ old('name') }}" minlength="2" maxlength="191">
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-12">
                            <label for="lastname" class="text-uppercase">LAST NAME</label>
                            <input id="lastname" name="lastname" type="text" class="form-control @error('email') is-invalid @enderror" required placeholder="Last name" value="{{ old('lastname') }}" minlength="2" maxlength="191">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="text-uppercase">EMAIL</label>
                        <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" required placeholder="{{ 'email@gmail.com' }}" value="{{ old('email') }}" minlength="5" maxlength="191">
                    </div>

                    <div class="form-group">
                        <label for="password" class="text-uppercase">PASSWORD</label>
                        <input id="password" name="password" type="password" class="form-control @error('password') is-invalid @enderror" required placeholder="********" minlength="8" maxlength="40">
                    </div>

                    <div class="form-group mb-2">
                        <input type="checkbox" name="terms" required id="terms-conditions">
                        <label class="text-body small mb-0" for="terms-conditions">I accept <a href="javascript:void(0);" class="text-primary" data-dismiss="modal" data-toggle="modal" data-target="#modal-terms">terms and conditions</a></label>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-login" action="register">Sign Up</button>
                    </div>

                    <div class="form-group">
                        Do you want to enter? <a href="{{ route('login') }}"><b>Sign in</b></a>
                    </div>
                </form>
            </div>

            <div class="col-lg-8 col-md-7 col-12 banner-sec">
                <img class="d-block img-fluid h-100 w-100" src="{{ asset("/auth/image.jpg") }}" alt="Image" title="Image">
            </div>
        </div>
    </div>
</section>

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