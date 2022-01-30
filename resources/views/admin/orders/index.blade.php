@extends('admin.layout')
@section('pageTitle', 'Danh sách đơn hàng')
@section('breadcrumb-first', 'Đơn hàng')
@section('breadcrumb-second', 'Danh sách đơn hàng')
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
            <form action="{{ route('don-hang.index') }}" class="form-group row mb-2">
                <div class="col-10">
                    Hiển thị
                    <?php $quantityDisplay = [10, 25, 50, 100]; ?>
                    <select name="filterQuantity" class="p-1">
                        @foreach ($quantityDisplay as $quantity)
                            <option value="{{ $quantity }}" @if (isset($params['filterQuantity']) && $params['filterQuantity'] == $quantity) selected @endif>
                                {{ $quantity }}</option>
                        @endforeach
                    </select>
                    &nbsp;
                    Phương thức thanh toán
                    <select name="filterMethod" class="p-1">
                        <option value="" @if (isset($params['filterMethod']) && $params['filterMethod'] == "") selected @endif>Phương thức thanh toán</option>
                        <option value="1" @if (isset($params['filterMethod']) && $params['filterMethod'] == "1") selected @endif>Thanh toán khi nhận hàng</option>
                        <option value="2" @if (isset($params['filterMethod']) && $params['filterMethod'] == "2") selected @endif>Thanh toán online</option>
                    </select>
                    &nbsp;
                    Trạng thái
                    <select name="filterStatus" class="p-1">
                        <option value="" @if (isset($params['filterStatus']) && $params['filterStatus'] == "") selected @endif>Trạng thái</option>
                        <option value="0" @if (isset($params['filterStatus']) && $params['filterStatus']  == "0") selected @endif>Chờ xác nhận</option>
                        <option value="1" @if (isset($params['filterStatus']) && $params['filterStatus'] == "1") selected @endif>Đang chuẩn bị đơn hàng</option>
                        <option value="2" @if (isset($params['filterStatus']) && $params['filterStatus'] == "2") selected @endif>Đang giao</option>
                        <option value="3" @if (isset($params['filterStatus']) && $params['filterStatus'] == "3") selected @endif>Đã giao</option>
                        <option value="4" @if (isset($params['filterStatus']) && $params['filterStatus'] == "4") selected @endif>Đã hủy</option>
                    </select>
                </div>
                <div class="col-2">
                    <button class="float-right p-1" type="submit">
                        <i class="fa fa-search"></i> Tìm kiếm</button>
                </div>
            </form>
            <div class="card-box table-responsive">
                <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Sản phẩm</th>
                            <th>Phương thức</th>
                            <th>Giá tiền</th>
                            <th>Trạng thái</th>
                            <th>Ngày đặt</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>
                                    @foreach ($order->orderDetails as $od)
                                        <?= $od->productDetails->products->name_vi ?? '' ?>
                                        <span> <i
                                                style="width:12px;height: 12px;background:{{ $od->productDetails->colors->code }}; display: inline-block; border-radius: 50%"></i></span>
                                        <span>x {{ $od->quantity }}</span>
                                        <br>
                                    @endforeach
                                </td>
                                <td>{{ $order->method == 1 ? 'Thanh toán khi nhận hàng' : 'Thanh toán online' }}<br>

                                <td>{{ number_format($order->price) }}đ</td>
                                <td>@php
                                    $status = [
                                        0 => 'Chờ xác nhận',
                                        1 => 'Đang chuẩn bị đơn hàng',
                                        2 => 'Đang giao',
                                        3 => 'Đã giao',
                                        4 => 'Đã hủy',
                                    ];
                                    $colors = [
                                        0 => 'text-warning',
                                        1 => 'text-primary',
                                        2 => 'text-info',
                                        3 => 'text-success',
                                        4 => 'text-danger',
                                    ];
                                @endphp
                                    <form action="{{ route('don-hang.update', $order->id) }}" method="post"
                                        class="mr-2  float-left">
                                        {{ csrf_field() }}
                                        {!! method_field('patch') !!}
                                        <span
                                            class="{{ $colors[$order->status] }} font-weight-bold">{{ $status[$order->status] }}</span>
                                        <select class="form-control" name="status" id="example-text-input"
                                            onchange="this.form.submit()">
                                            @foreach ($status as $key => $st)
                                                <option value="{{ $key }}" @if ($order->status == $key) selected @endif>
                                                    {{ $st }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </form>

                                </td>
                                <td>{{ date('d-m-Y H:i:s', strtotime($order->created_at)) }}</td>
                                <td>
                                    <a href="{{ route('don-hang.show', $order->id) }}"><button
                                            type="button"
                                            class="btn btn-custom waves-effect waves-light  float-left mr-2 ">Chi
                                            tiết</button></a>
                                    <form action="{{ route('don-hang.destroy', $order->id) }}" method="post"
                                        class="mr-2">
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
                {{ $orders->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
@endsection
