@extends('client.layout')
@section('main')
    <!-- BREADCRUMBS SETCTION START -->
    <div class="breadcrumbs-section plr-200 mb-80">
        <div class="breadcrumbs overlay-bg">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="breadcrumbs-inner">
                            <h1 class="breadcrumbs-title">Đặt lại mật khẩu</h1>
                            <ul class="breadcrumb-list">
                                <li><a href="{{ route('homeClient') }}">Trang chủ</a></li>
                                <li>Đặt lại mật khẩu</li>
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
                            @if (session()->has('message_success'))
                                <div class="alert alert-success">
                                    {{ session()->get('message_success') }}
                                    <a href="{{ route('loginClient') }}">Đăng nhập ngay</a>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-2">
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="registered-customers">
                            <h6 class="widget-title border-left mb-50">ĐẶT LẠI MẬT KHẨU</h6>
                            <form action="/reset-password/{{$token}}" method="POST">
                                @csrf
                                <div class="login-account p-30 box-shadow">
                                    <p>Nhập mật khẩu dưới đây để cập nhật lại mật khẩu mới</p>
                                    <input type="password" name="password" placeholder="Mật khẩu mới..." style="margin-bottom:0px">
                                    <div style="color:red" class="mb-20">
                                        @error('password')
                                            <i class="typcn typcn-delete"></i> {{ $message }}
                                        @enderror
                                    </div>
                                    <input type="password" name="confirm_password" placeholder="Xác nhận mật khẩu mới..." style="margin-bottom:0px">
                                    <div style="color:red" class="mb-20">
                                        @error('confirm_password')
                                            <i class="typcn typcn-delete"></i> {{ $message }}
                                        @enderror
                                    </div>
                                    <button class="submit-btn-1 btn-hover-1" type="submit">Cập nhật mật khẩu mới</button>
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
