@extends('client.layout')
@section('title', trans('message.forgot_password'))
@section('main')
    <!-- BREADCRUMBS SETCTION START -->
    <div class="breadcrumbs-section plr-200 mb-80">
        <div class="breadcrumbs overlay-bg">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="breadcrumbs-inner">
                            <h1 class="breadcrumbs-title">{{ trans('message.forgot_password') }}</h1>
                            <ul class="breadcrumb-list">
                                <li><a href="{{ route('homeClient') }}">{{ trans('message.home') }}</a></li>
                                <li>{{ trans('message.forgot_password') }}</li>
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
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-8">
                            @if (session()->has('message_error'))
                                <div class="alert alert-danger">
                                    {{ session()->get('message_error') }}
                                </div>
                            @endif
                            @if (session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session()->get('message') }}
                                </div>
                            @endif
                        </div>
                        <div class="col-md-2">
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="registered-customers">
                            <h6 class="widget-title border-left mb-50">{{ trans_choice('message.get_password_with_email', 0) }}</h6>
                            <form action="{{ route('sendMail') }}" method="POST">
                                @csrf
                                <div class="login-account p-30 box-shadow">
                                    <p>{{ trans_choice('message.get_password_with_email', 1) }}</p>
                                    <input type="text" name="email" placeholder="{{ trans('message.email_address') }}"
                                        value="{{ old('email') }}" style="margin-bottom:0px">
                                    <div style="color:red" class="mb-20">
                                        @error('email')
                                            <i class="typcn typcn-delete"></i> {{ $message }}
                                        @enderror
                                    </div>
                                    <button class="submit-btn-1 btn-hover-1" type="submit">{{ trans('message.password_retrieval') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div>
        </div>
        <!-- LOGIN SECTION END -->

    </div>
    <!-- End page content -->
@endsection
