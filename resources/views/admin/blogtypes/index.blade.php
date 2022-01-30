@extends('admin.layout')
@section('pageTitle','Danh sách loại tin')
@section('breadcrumb-first','Loại tin')
@section('breadcrumb-second','Danh sách loại tin')
@section('main')
@if(session()->has('success'))
<div class="alert alert-success" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
    <strong class="d-block d-sm-inline-block-force">Thông báo</strong> {{session()->get('success')}}
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
<a class="btn btn-custom waves-effect waves-light mb-2" href="{{ route('loai-blog.create') }}">Thêm loại</a>

<div class="row">
    <div class="col-12">
        <div class="card-box table-responsive">
            <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên màu sắc</th>
                        <th>Mô tả</th>
                        <th>ẩn hiện</th>
                        <th>slug</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($Blogtypes as $Blogtype)
                    <tr>
                        <td>{{$Blogtype->id}}</td>
                        <td>{{$Blogtype->title}}</td>
                        <td>{{$Blogtype->description}}</td>
                        <td>
                            @if ($Blogtype->display==0)
                                Ẩn
                                @else
                                Hiện
                            @endif
                        </td>
                        <td>{{$Blogtype->slug}}</td>
                        <td class="d-flex">
                            <a href="{{route('loai-blog.edit',$Blogtype->id)}}" class="mr-3"><button type="button"
                                    class="btn btn-custom waves-effect waves-light  float-left mr-2 ">Sửa</button></a>
                            <form action="{{route('loai-blog.destroy',$Blogtype->id)}}" method="post" class="mr-2  float-left">
                                {{csrf_field()}}
                                {!! method_field('delete') !!}
                                <button type="submit" class="btn btn-danger waves-effect waves-light"
                                    onclick="return confirm('Chấp nhận xóa?')">Xóa</button>
                            </form>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        
        </div>
    </div>
</div>
@endsection