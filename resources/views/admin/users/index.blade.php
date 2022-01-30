@extends('admin.layout')
@section('pageTitle', 'Danh sách tài khoản')
@section('breadcrumb-first', 'Tài khoản')
@section('breadcrumb-second', 'Danh sách tài khoản')
@section('main')
    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <strong class="d-block d-sm-inline-block-force">Thông báo</strong> {{ session()->get('success') }}
        </div>
    @endif
    @if (session()->has('errors'))
        <div class="alert alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <strong class="d-block d-sm-inline-block-force">Thông báo</strong> {{ session()->get('errors') }}
        </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card-box table-responsive">
                <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th width="15%">Họ tên</th>
                            <th width="10%">Email</th>
                            <th width="15%">Địa chỉ</th>
                            <th>Quyền hạn - Cấp bậc</th>
                            <th>Ngày tạo</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->diachi }}</td>
                                <td>{{ $user->idgroup == 1 ? 'Quản trị viên' : 'Người dùng' }} - {{ $user->level }}</td>
                                <td>{{ $user->created_at ? date('d/m/Y H:i ', strtotime($user->created_at)) : '' }}</td>
                                <td class="d-flex">
                                    @if (auth()->user()->level > $user->level)
                                        <a href="{{ route('tai-khoan.edit', $user->id) }}" class="mr-3"><button
                                                type="button"
                                                class="btn btn-custom waves-effect waves-light">Sửa</button></a>
                                        <form action="{{ route('tai-khoan.destroy', $user->id) }}" method="post">
                                            {{ csrf_field() }}
                                            {!! method_field('delete') !!}
                                            <button type="submit" class="btn btn-danger waves-effect waves-light"
                                                onclick="return confirm('Chấp nhận xóa?')">Xóa</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $users->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
@endsection
