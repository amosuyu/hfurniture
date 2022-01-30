@extends('client.layout')
@section('title', trans('message.login').' / '.trans('message.register'))
@section('main')
    <!-- BREADCRUMBS SETCTION START -->
    <div class="breadcrumbs-section plr-200 mb-80">
        <div class="breadcrumbs overlay-bg">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="breadcrumbs-inner">
                            <h1 class="breadcrumbs-title">{{ trans('message.login') }} / {{ trans('message.register') }}
                            </h1>
                            <ul class="breadcrumb-list">
                                <li><a href="{{ route('homeClient') }}">{{ trans('message.home') }}</a></li>
                                <li>{{ trans('message.login') }} / {{ trans('message.register') }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BREADCRUMBS SETCTION END -->

    <!-- Start page content -->
    <div id="page-content" class="page-wrapper">

        <!-- LOGIN SECTION START -->
        <div class="login-section mb-80">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            @if (session()->has('login_message'))
                                <div class="alert alert-danger">
                                    {{ session()->get('login_message') }}
                                </div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            @if (session()->has('register_message'))
                                <div class="alert alert-danger">
                                    {{ session()->get('register_message') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="registered-customers">
                            <h6 class="widget-title border-left mb-50">{{ trans_choice('message.customer_login', 0) }}
                            </h6>
                            <form action="{{ route('handleLogin') }}" method="POST">
                                @csrf
                                <div class="login-account p-30 box-shadow">
                                    <p>{{ trans_choice('message.customer_login', 10) }}</p>
                                    <input type="text" name="email_log"
                                        placeholder="{{ trans('message.email_address') }}..."
                                        value="{{ old('email_log') }}" style="margin-bottom:0px">
                                    <div style="color:red" class="mb-20">
                                        @error('email_log')
                                            <i class="typcn typcn-delete"></i> {{ $message }}
                                        @enderror
                                    </div>
                                    <input type="password" name="password_log"
                                        placeholder="{{ trans('message.password') }}" style="margin-bottom:0px">
                                    <div style="color:red" class="mb-20">
                                        @error('password_log')
                                            <i class="typcn typcn-delete"></i> {{ $message }}
                                        @enderror
                                    </div>
                                    <p><small><a
                                                href="{{ route('forgotPassword') }}">{{ trans('message.forgot_password') }}?</a></small>
                                    </p>
                                    <button class="submit-btn-1 btn-hover-1"
                                        type="submit">{{ trans('message.login') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- new-customers -->
                    <div class="col-md-6">
                        <div class="new-customers">
                            <form action="{{ route('handleRegister') }}" method="POST">
                                @csrf
                                <h6 class="widget-title border-left mb-50">{{ trans('message.customer_register') }}</h6>
                                <div class="login-account p-30 box-shadow">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <input type="text" name="name"
                                                placeholder="{{ trans('message.full_name') }}..."
                                                value="{{ old('name') }}" style="margin-bottom:0px">
                                            <div style="color:red" class="mb-20">
                                                @error('name')
                                                    <i class="typcn typcn-delete"></i> {{ $message }}
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <select class="custom-select" name="gender" style="margin-bottom:0px">
                                                <option value="">{{ trans('message.gender') }}</option>
                                                <option value="1" @if (old('gender') == '1') selected @endif>{{ trans('message.male') }}
                                                </option>
                                                <option value="0" @if (old('gender') == '0') selected @endif>{{ trans('message.female') }}
                                                </option>
                                            </select>
                                            <div style="color:red" class="mb-20">
                                                @error('gender')
                                                    <i class="typcn typcn-delete"></i> {{ $message }}
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" name="phone" placeholder="{{ trans('message.phone') }}..."
                                                value="{{ old('phone') }}" style="margin-bottom:0px">
                                            <div style="color:red" class="mb-20">
                                                @error('phone')
                                                    <i class="typcn typcn-delete"></i> {{ $message }}
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <input type="text" name="address" placeholder="{{ trans('message.address') }}..."
                                        value="{{ old('address') }}" style="margin-bottom:0px">
                                    <div style="color:red" class="mb-20">
                                        @error('address')
                                            <i class="typcn typcn-delete"></i> {{ $message }}
                                        @enderror
                                    </div>
                                    <input type="text" name="email" placeholder="{{ trans('message.email_address') }}..."
                                        value="{{ old('email') }}" style="margin-bottom:0px">
                                    <div style="color:red" class="mb-20">
                                        @error('email')
                                            <i class="typcn typcn-delete"></i> {{ $message }}
                                        @enderror
                                    </div>
                                    <input type="password" name="password"
                                        placeholder="{{ trans('message.password') }}..." style="margin-bottom:0px">
                                    <div style="color:red" class="mb-20">
                                        @error('password')
                                            <i class="typcn typcn-delete"></i> {{ $message }}
                                        @enderror
                                    </div>
                                    <input type="password" name="confirm_password"
                                        placeholder="{{ trans('message.confirm_password') }}..."
                                        style="margin-bottom:0px">
                                    <div style="color:red" class="mb-20">
                                        @error('confirm_password')
                                            <i class="typcn typcn-delete"></i> {{ $message }}
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button class="submit-btn-1 mt-20 btn-hover-1" type="submit"
                                                value="register">{{ trans('message.register') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- LOGIN SECTION END -->

    </div>
    <!-- End page content -->
@endsection