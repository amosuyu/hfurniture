@extends('admin.layout')
@section('pageTitle', 'Danh sách chính sách')
@section('breadcrumb-first', 'Chính sách')
@section('breadcrumb-second', 'Danh sách chính sách')
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
    <a class="btn btn-custom waves-effect waves-light mb-2" href="{{ route('chinh-sach.create') }}">Thêm chính sách</a>
    <div class="row">
        <div class="col-12">
            <div class="card-box table-responsive">
                <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên chính sách</th>
                            <th>Slug</th>
                            <th>Ẩn hiện</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($policies as $policy)
                            <tr>
                                <td>{{ $policy->id }}</td>
                                <td>{{ $policy->name }}</td>
                                <td>{{ $policy->slug }}</td>
                                <td>
                                    @if ($policy->display == 0)
                                        Ẩn
                                    @else
                                        Hiện
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('chinh-sach.edit', $policy->id) }}" class="mr-3"><button
                                            type="button"
                                            class="btn btn-custom waves-effect waves-light  float-left mr-2 ">Sửa</button></a>
                                    <form action="{{ route('chinh-sach.destroy', $policy->id) }}" method="post"
                                        class="mr-2  float-left">
                                        {{ csrf_field() }}
                                        {!! method_field('delete') !!}
                                        <button type="submit" class="btn btn-danger waves-effect waves-light"
                                            onclick="return confirm('Chấp nhận xóa?')">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $policies->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
    </div>
@endsection
