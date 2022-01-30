@extends('admin.layout')
@section('pageTitle', 'Danh sách không gian')
@section('breadcrumb-first', 'Không gian')
@section('breadcrumb-second', 'Danh sách không gian')
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
    <a class="btn btn-custom waves-effect waves-light mb-2" href="{{ route('khong-gian.create') }}">Thêm không gian</a>
    <div class="row">
        <div class="col-12">
            <div class="card-box table-responsive">
                <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên không gian</th>
                            <th>Space name</th>
                            <th>Mô tả</th>
                            <th>Ngôn ngữ</th>
                            <th>Ẩn hiện</th>
                            <th>Slug</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($spaces as $space)
                            <tr>
                                <td>{{ $space->id }}</td>
                                <td>{{ $space->name_vi }}</td>
                                <td>{{ $space->name_en }}</td>
                                <td>{{ $space->description_vi }}</td>
                                <td>@if ($space->name_vi)<img width="30px" src="{{ asset('img/flag-vn.png') }}"/> @endif
                                    @if ($space->name_en)<img width="30px" src="{{ asset('img/flag-en.jpg') }}"/> @endif
                                </td>
                                <td>
                                    @if ($space->display == 0)
                                        Ẩn
                                    @else
                                        Hiện
                                    @endif
                                </td>
                                <td>{{ $space->slug }}</td>
                                <td>
                                    <a href="{{ route('khong-gian.edit', $space->id) }}" class="mr-3"><button
                                            type="button"
                                            class="btn btn-custom waves-effect waves-light  float-left mr-2 ">Sửa</button></a>
                                    <form action="{{ route('khong-gian.destroy', $space->id) }}" method="post"
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
                {{ $spaces->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
    </div>
@endsection
