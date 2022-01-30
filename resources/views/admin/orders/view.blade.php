@extends('admin.layout')
@section('pageTitle', 'Chi tiết đơn hàng')
@section('breadcrumb-first', 'Đơn hàng')
@section('breadcrumb-second', 'Chi tiết đơn hàng')
@section('cssLink')
    <!-- X-editable css -->
    <link type="text/css" href="{{ asset('assets') }}/plugins/x-editable/css/bootstrap-editable.css" rel="stylesheet">
@endsection
@section('main')
    <a href="{{ route('don-hang.index') }}"><i class="fa fa-angle-double-left"></i>&nbsp; Quay lại</a>
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <form action="" method="post">
                    <div class="row">
                        <div class="@if($order->payments) col-6 @else col-12 @endif">
                            <div class="card-box">
                                <h4 class="m-b-30 m-t-0 header-title">Đơn hàng M{{ $order->id }}</h4>
                                <table class="table table-borderless table-striped">
                                    <tbody>
                                        <tr>
                                            <td width="40%">Họ và tên</td>
                                            <td width="60%">{{ $order->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>{{ $order->email }}</td>
                                        </tr>
                                        <tr>
                                            <td>Số điện thoại</td>
                                            <td>{{ $order->phone }}</td>
                                        </tr>
                                        <tr>
                                            <td>Địa chỉ</td>
                                            <td>{{ $order->address }}</td>
                                        </tr>
                                        <tr>
                                            <td>Tỉnh Thành phố</td>
                                            <td>{{ $order->city }}</td>
                                        </tr>
                                        <tr>
                                            <td>Quận Huyện</td>
                                            <td>{{ $order->district }}</td>
                                        </tr>
                                        <tr>
                                            <td>Phường Xã</td>
                                            <td>{{ $order->ward }}</td>
                                        </tr>
                                        <tr>
                                            <td>Trạng thái</td>
                                            <td>
                                                <form action="{{ route('don-hang.update', $order->id) }}" method="post"
                                                    class="mr-2  float-left">
                                                    {{ csrf_field() }}
                                                    {!! method_field('patch') !!}
                                                    <select class="form-control" name="status"
                                                        onchange="this.form.submit()">
                                                        @foreach ($status as $key => $sts)
                                                            <option value="{{ $key }}" @if ($key == $order->status) selected @endif>
                                                                {{ $sts }}</option>
                                                        @endforeach
                                                    </select>
                                                </form>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Phương thức thanh toán</td>
                                            <td>{{ $order->status == 0 ? 'Thanh toán khi giao hàng' : 'Thanh toán online' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Tổng giá tiền</td>
                                            <td>{{ number_format($order->price) }}đ</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @if($order->payments)
                        <div class="col-6">
                            <div class="card-box">
                                <h4 class="m-b-30 m-t-0 header-title">Chi tiết giao dịch</h4>
                                <table class="table table-borderless table-striped">
                                    <tbody>
                                        <tr>
                                            <td width="40%">Mã giao dịch</td>
                                            <td width="60%">{{ $order->payments->trade_code ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Ngân hàng</td>
                                            <td>{{ $order->payments->bank_code ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Mã giao dịch ngân hàng</td>
                                            <td>{{ $order->payments->bank_pay_code ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Loại</td>
                                            <td>{{ $order->payments->type ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Ngày giao dịch</td>
                                            <td>{{ $order->payments->created_at ?? '' }}</td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @endif

                    </div>
                </form>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <h4 class="m-t-0 header-title">Chi tiết sản phẩm</h4>

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Hình</th>
                                        <th>Màu</th>
                                        <th>Số lượng</th>
                                        <th>Giá</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->orderDetails as $item)
                                    <tr>
                                        <th scope="row">{{ $item->id }}</th>
                                        <td>{{ $item->productDetails->products->name_vi }}<br>{{ $item->productDetails->products->name_en }}</td>
                                        <td><img style="width: 100px" src="{{ asset($item->productDetails->products->image) }}" onerror="this.src='{{asset('img/empty.png')}}'"></td>
                                        <td><div style="width:50px;height: 50px;background:{{ $item->productDetails->colors->code }}"></div></td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ number_format($item->price) }}đ</td>
                                    </tr>
                                    @endforeach
                                    

                                </tbody>
                            </table>
                        </div>

                    </div>


                </div>
                <!-- end row -->
            </div>
        </div><!-- end col -->
    </div>
@endsection
@section('jsScript')
    <!-- XEditable Plugin -->
    <script src="{{ asset('assets') }}/plugins/moment/moment.js"></script>
    <script type="text/javascript" src="{{ asset('assets') }}/plugins/x-editable/js/bootstrap-editable.min.js"></script>
    <script type="text/javascript" src="{{ asset('assets') }}/pages/jquery.xeditable.js"></script>

@endsection
