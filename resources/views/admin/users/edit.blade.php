@extends('admin.layout')
@section('pageTitle', 'Sửa tài khoản')
@section('breadcrumb-first', 'Tài khoản')
@section('breadcrumb-second', 'Sửa tài khoản')
@section('main')
    <a class="text-primary waves-effect waves-light mb-2" href="{{ route('tai-khoan.index') }}"><i
            class="fa fa-angle-double-left"></i>&nbsp;Quay lại</a>
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <form action="{{ route('tai-khoan.update', $user->id) }}" method="POST">
                    {{ csrf_field() }}
                    {!! method_field('patch') !!}

                    <div class="form-group row">
                        <label for="disabledName" class="col-2 col-form-label">Họ tên</label>
                        <div class="col-10">
                            <input type="text" id="disabledName" disabled class="form-control" value="{{ $user->name }}">

                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="disabledEmail" class="col-2 col-form-label">Email</label>
                        <div class="col-10">
                            <input type="email" id="disabledEmail" disabled class="form-control"
                                value="{{ $user->email }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="disabledPassword" class="col-2 col-form-label">Mật khẩu</label>
                        <div class="col-10">
                            <input type="password" id="disabledPassword" disabled class="form-control"
                                value="{{ $user->password }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="disabledAddress" class="col-2 col-form-label">Số điện thoại</label>
                        <div class="col-10">
                            <input type="text" id="disabledAddress" disabled class="form-control"
                                value="{{ $user->phone }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="disabledAddress" class="col-2 col-form-label">Địa chỉ</label>
                        <div class="col-10">
                            <input type="text" id="disabledAddress" disabled class="form-control"
                                value="{{ $user->diachi }}">
                        </div>
                    </div>
                    @if (auth()->user()->level > $user->level)
                        <div class="form-group row">
                            <label class="col-sm-2">Quyền</label>
                            <div class="col-sm-5 d-flex">
                                <div class="radio mr-5">
                                    <input type="radio" name="idgroup" id="qt" value="1" @if ($user->idgroup == '1') checked @endif>
                                    <label for="qt">
                                        Quản trị viên
                                    </label>
                                </div>
                                <div class="radio">
                                    <input type="radio" name="idgroup" id="nd" value="0" @if ($user->idgroup == '0') checked @endif>
                                    <label for="nd">
                                        Người dùng
                                    </label>
                                </div>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="level" class="col-2 col-form-label">Cấp bậc</label>
                            <div class="col-10">
                                <input type="number" min="0" max="{{auth()->user()->level === 9999 ? 9 : auth()->user()->level - 1 }}" id="level" name="level" class="form-control"
                                    value="{{ $user->level }}">
                            </div>
                        </div>
                    @endif
                    <div class="form-group row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
