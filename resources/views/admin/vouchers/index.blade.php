@extends('admin.layout')
@section('pageTitle','Danh sách vouchers')
@section('breadcrumb-first','Vouchers')
@section('breadcrumb-second','Danh sách vouchers')
@section('main')
@if(session()->has('success'))
<div class="alert alert-success" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
    <strong class="d-block d-sm-inline-block-force">Thông báo</strong> {{session()->get('success')}}
</div>
@endif

<a class="btn btn-custom waves-effect waves-light mb-2" href="{{ route('giam-gia.create') }}">Thêm voucher</a>

<div class="row">
    <div class="col-12">
        <div class="card-box table-responsive">
            <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Mã giảm</th>
                        <th>Mô tả</th>
                        <th>Số tiền giảm</th>
                        <th>Phần trăm giảm</th>
                        <th>Ngày kết thúc</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($Vouchers as $Voucher)
                    <tr>
                        <td>{{$Voucher->id}}</td>
                        <td>{{$Voucher->code}}</td>
                        <td>{{$Voucher->description}}</td>
                        <td>{{$Voucher->amount}}</td>
                        <td>{{$Voucher->percent}}</td>
                        <td>{{$Voucher->end_date}}</td>
                        <td class="d-flex">
                            <a href="{{route('giam-gia.edit',$Voucher->id)}}" class="mr-3 float-left"><button type="button"
                                    class="btn btn-custom waves-effect waves-light">Sửa</button></a>
                            <form action="{{route('giam-gia.destroy',$Voucher->id)}}" method="post">
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