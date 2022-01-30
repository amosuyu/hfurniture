@extends('client.layout')
@section('title', trans('message.cart') )
@section('main')
    <!-- BREADCRUMBS SETCTION START -->
    <div class="breadcrumbs-section plr-200 mb-80">
        <div class="breadcrumbs overlay-bg">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="breadcrumbs-inner">
                            <h1 class="breadcrumbs-title">{{ trans('message.cart') }}</h1>
                            <ul class="breadcrumb-list">
                                <li><a href="{{ route('homeClient') }}">{{ trans('message.home') }}</a></li>
                                <li>{{ trans('message.cart') }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BREADCRUMBS SETCTION END -->
    <!-- Start page content -->
    <section id="page-content" class="page-wrapper">
        <!-- SHOP SECTION START -->
        <div class="shop-section mb-80">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 col-sm-12">
                        <ul class="cart-tab">
                            <li>
                                <a class="active" href="{{ route('listCart') }}" data-toggle="tab">
                                    <span>01</span>
                                    {{ trans('message.cart') }}
                                </a>
                            </li>
                            <li>
                                <a href="javascript:" style="pointer-events: none;
                                cursor: default;">
                                    <span>02</span>
                                    {{ trans('message.payment') }}
                                </a>
                            </li>
                            <li>
                                <a href="javascript:" style="pointer-events: none;
                                cursor: default;">
                                    <span>03</span>
                                    {{ trans('message.successfully') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-10 col-sm-12">
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <!-- shopping-cart start -->
                            <div class="tab-pane active" id="shopping-cart">
                                <div class="shopping-cart-content">
                                    <div class="table-content table-responsive mb-50">
                                        <table class="text-center">
                                            <thead>
                                                <tr>
                                                    <th class="product-thumbnail">{{ trans('message.product') }}</th>
                                                    <th class="product-price">{{ trans('message.price') }}</th>
                                                    <th class="product-quantity">{{ trans('message.quantity') }}</th>
                                                    <th class="product-subtotal">{{ trans('message.total') }}</th>
                                                    <th class="product-subtotal">{{ trans('message.save') }}</th>
                                                    <th class="product-remove">{{ trans('message.delete') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (Session::has('Cart') != null)
                                                    <tr>
                                                        <td colspan="4"></td>
                                                        <td class="product-remove">
                                                            <a href="javascript:"
                                                                onclick="saveAllListCart()"><i
                                                                    class="zmdi zmdi-save"></i></a>
                                                        </td>
                                                        <td class="product-remove">
                                                            <a href="javascript:"
                                                                onclick="deleteAllListCart()"><i
                                                                    class="zmdi zmdi-close"></i></a>
                                                        </td>
                                                    </tr>
                                                    @foreach (Session::get('Cart')->products as $item)
                                                        <!-- tr -->
                                                        <tr>
                                                            <td class="product-thumbnail">
                                                                <div class="pro-thumbnail-img">
                                                                    <img src="{{ asset($item['productInfo']->image) }}"
                                                                        onerror="this.src='{{ asset('img/empty.png') }}'"
                                                                        alt="">
                                                                </div>
                                                                <div class="pro-thumbnail-info text-left">
                                                                    <h6>
                                                                        <a href="{{ route('productDetail', $item['productInfo']->product_id) }}">
                                                                            @if(Session::get('website_language') == 'en')
                                                                            {{ $item['productInfo']->nameEn }}
                                                                            @else
                                                                            {{ $item['productInfo']->nameVi }}
                                                                            @endif
                                                                        </a>
                                                                    </h6>
                                                                    <p> {{ trans('message.color') }}: <span class="mt-1"
                                                                            style="border:solid lightgray 1px;height: 13px;width: 13px;background-color: {{ $item['productInfo']->color }};border-radius: 50%;display: inline-block;"></span>
                                                                    </p>
                                                                </div>
                                                            </td>
                                                            <td class="product-price">
                                                                <span
                                                                    style=" color: #666;font-size: 17px;font-weight: bold;margin-right: 10px">{{ number_format($item['productInfo']->price - ($item['productInfo']->price * $item['productInfo']->discount) / 100) }}đ</span>
                                                                <br>
                                                                <span
                                                                    style="color: #a6a6a6;font-size: 15px;text-decoration: line-through;">{{ number_format($item['productInfo']->price) }}đ</span>
                                                            </td>
                                                            <td class="product-quantity">
                                                                <div class="cart-plus-minus f-left">
                                                                    <input
                                                                        id="quantity-item-{{ $item['productInfo']->id }}"
                                                                        type="text" value="{{ $item['quantity'] }}" data-id="{{ $item['productInfo']->id }}"
                                                                        min="1" name="qtybutton" class="cart-plus-minus-box"
                                                                        onkeyup="qtyFunction({{ $item['productInfo']->id }})">
                                                                </div>
                                                            </td>
                                                            <td class="product-subtotal">
                                                                {{ number_format($item['price']) }}đ</td>
                                                            <td class="product-remove">
                                                                <a href="javascript:"
                                                                    onclick="saveItemListCart({{ $item['productInfo']->id }})"><i
                                                                        class="zmdi zmdi-save"></i></a>
                                                            </td>
                                                            <td class="product-remove">
                                                                <a href="javascript:"
                                                                    onclick="deleteItemListCart({{ $item['productInfo']->id }})"><i
                                                                        class="zmdi zmdi-close"></i></a>
                                                            </td>
                                                        </tr>
                                                        <!-- tr -->
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="6">{{ trans('message.cart_empty') }}</td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="coupon-discount box-shadow p-30 mb-50">
                                                <h6 class="widget-title border-left mb-20">{{ trans('message.voucher') }}</h6>
                                                <p>{{ trans('message.enter_voucher') }}</p>
                                                <input type="text" name="voucher" id="voucher-code"
                                                    placeholder="{{ trans('message.voucher') }}...">
                                                <button class="submit-btn-1 black-bg btn-hover-2" type="button"
                                                    onclick="useVoucher()">{{ trans('message.apply_voucher') }}</button>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="payment-details box-shadow p-30 mb-50" id="payment-detail">
                                                <h6 class="widget-title border-left mb-20">{{ trans('message.total_detail') }}</h6>
                                                <table>
                                                    <tr>
                                                        <td class="td-title-1">{{ trans('message.total') }}</td>
                                                        <td class="td-title-2">
                                                            {{ number_format(Session::get('Cart')->totalPrice ?? 0) }}đ
                                                        </td>
                                                    </tr>
                                                    @if (Session::has('Voucher') != null && Session::has('Cart') != null)
                                                        <tr>
                                                            <td class="td-title-1">{{ trans('message.discount') }}</td>
                                                            <td class="td-title-2">
                                                                @if (Session::get('Voucher')->amount > 0)
                                                                    -
                                                                    {{ number_format(Session::get('Voucher')->amount) }}đ
                                                                @else
                                                                    -
                                                                    {{ number_format(Session::get('Cart')->totalPrice - (Session::get('Cart')->totalPrice - (Session::get('Cart')->totalPrice * Session::get('Voucher')->percent) / 100)) }}đ
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endif
                                                    <tr>
                                                        <td class="order-total">{{ trans('message.total_order') }}</td>
                                                        <td class="order-total-price">
                                                            @if (Session::has('Cart') != null)
                                                                @if (Session::has('Voucher') != null)
                                                                    @if (Session::get('Voucher')->amount > 0)
                                                                        {{ number_format(Session::get('Cart')->totalPrice - Session::get('Voucher')->amount) }}đ
                                                                    @else
                                                                        {{ number_format(Session::get('Cart')->totalPrice - (Session::get('Cart')->totalPrice * Session::get('Voucher')->percent) / 100) }}đ
                                                                    @endif
                                                                @else {{ number_format(Session::get('Cart')->totalPrice) ?? 0 }}đ
                                                                @endif
                                                            @endif
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-right">
                                            <button class="submit-btn-1 black-bg btn-hover-2" type="button"
                                            onclick="location.href='thanh-toan'"
                                           >{{ trans('message.payment') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- shopping-cart end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- SHOP SECTION END -->

    </section>
    <!-- End page content -->
@endsection
