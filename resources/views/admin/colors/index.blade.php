@extends('admin.layout')
@section('pageTitle','Danh sách màu sắc')
@section('breadcrumb-first','Màu sắc')
@section('breadcrumb-second','Danh sách màu sắc')
@section('main')
@if(session()->has('success'))
<div class="alert alert-success" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
    <strong class="d-block d-sm-inline-block-force">Thông báo</strong> {{session()->get('success')}}
</div>
@endif
@if(session()->has('errors'))
<div class="alert alert-danger" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
    <strong class="d-block d-sm-inline-block-force">Thông báo</strong> {{session()->get('errors')}}
</div>
@endif
<a class="btn btn-custom waves-effect waves-light mb-2" href="{{ route('mau-sac.create') }}">Thêm màu</a>

<div class="row">
    <div class="col-12">
        <div class="card-box table-responsive">
            <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên màu sắc</th>
                        <th>Mã màu</th>
                        <th>Màu sắc</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($Colors as $color)
                    <tr>
                        <td>{{$color->id}}</td>
                        <td>{{$color->name}}</td>
                        <td>{{$color->code}}</td>
                        
                        <td><div style="width:50px;height: 50px;background:{{$color->code}}"></div></td>
                        <td class="d-flex">
                            <a href="{{route('mau-sac.edit',$color->id)}}" class="mr-3"><button type="button"
                                    class="btn btn-custom waves-effect waves-light  float-left mr-2 ">Sửa</button></a>
                            <form action="{{route('mau-sac.destroy',$color->id)}}" method="post" class="mr-2  float-left">
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