@extends('client.layout')
@section('css')
    <style>
        .error {
            color: red;
        }

        .payment_checked {
            color: #ff7f00;
            border: solid 1px
        }

    </style>
@endsection
@section('title', trans('message.payment'))
@section('main')
    <!-- BREADCRUMBS SETCTION START -->
    <div class="breadcrumbs-section plr-200 mb-80">
        <div class="breadcrumbs overlay-bg">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="breadcrumbs-inner">
                            <h1 class="breadcrumbs-title">{{ trans('message.payment') }}</h1>
                            <ul class="breadcrumb-list">
                                <li><a href="{{ route('homeClient') }}">{{ trans('message.home') }}</a></li>
                                <li>{{ trans('message.payment') }}</li>
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
                                <a href="{{ route('listCart') }}" style="color: #ff7f00">
                                    <span style="border: 1px solid">01</span>
                                    {{ trans('message.cart') }}
                                </a>
                            </li>
                            <li>
                                <a class="active" href="#checkout" data-toggle="tab" style="color: #ff7f00">
                                    <span style="border: 1px solid">02</span>
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
                            <!-- checkout start -->
                            <div class="tab-pane active" id="checkout">
                                <div class="checkout-content box-shadow p-30">
                                    <form id="form-payment" action="{{ route('handlePayment') }}" method="POST"
                                        autocomplete="off">
                                        @csrf
                                        <div class="row">
                                            <!-- billing details -->
                                            <div class="col-md-6">
                                                <div class="billing-details pr-10">
                                                    <h6 class="widget-title border-left mb-20">
                                                        {{ trans('message.billing_details') }}</h6>
                                                    <input type="text" placeholder="{{ trans('message.full_name') }}..."
                                                        value="{{ Auth()->user()->name }}" name="name"
                                                        style="margin-bottom:0px">
                                                    <label id="name-error" class="mb-20 text-danger" style="color:red"
                                                        for="name"></label>
                                                    <input type="text"
                                                        placeholder="{{ trans('message.email_address') }}..."
                                                        value="{{ Auth()->user()->email }}" name="email"
                                                        style="margin-bottom:0px">
                                                    <label id="email-error" class="mb-20 text-danger" style="color:red"
                                                        for="email"></label>
                                                    <input type="text" placeholder="{{ trans('message.phone') }}..."
                                                        value="{{ Auth()->user()->phone }}" name="phone"
                                                        style="margin-bottom:0px">
                                                    <label id="phone-error" class="mb-20 text-danger" style="color:red"
                                                        for="phone"></label>
                                                    <select class="custom-select" id="payment_city" name="city"
                                                        onchange="changeCity(this)" style="margin-bottom:0px">
                                                        <option value="">{{ trans('message.city') }}</option>
                                                        @foreach ($cities as $city)
                                                            <option value="{{ $city['code'] }}">{{ $city['name'] }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <label id="city-error" class="mb-20 text-danger" style="color:red"
                                                        for="city"></label>
                                                    <select class="custom-select" id="payment_district" name="district"
                                                        onchange="changeDistrict(this)" style="margin-bottom:0px">
                                                        <option value="">{{ trans('message.district') }}</option>
                                                    </select>
                                                    <label id="district-error" class="mb-20 text-danger" style="color:red"
                                                        for="district"></label>
                                                    <select class="custom-select" id="payment_ward" name="ward"
                                                        style="margin-bottom:0px">
                                                        <option value="">{{ trans('message.ward') }}</option>
                                                    </select>
                                                    <label id="ward-error" class="mb-20 text-danger" style="color:red"
                                                        for="ward"></label>
                                                    <textarea class="custom-textarea" name="address"
                                                        placeholder="{{ trans('message.address') }}..."
                                                        style="margin-bottom:0px">{{ Auth()->user()->address }}</textarea>
                                                    <label id="address-error" class="mb-20 text-danger" style="color:red"
                                                        for="address"></label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <!-- our order -->
                                                <div class="payment-details pl-10 mb-50">
                                                    <h6 class="widget-title border-left mb-20">
                                                        {{ trans('message.order_details') }}</h6>
                                                    <table id="payment_order">
                                                        @foreach (Session::get('Cart')->products as $item)
                                                            <tr>
                                                                <td class="td-title-1">
                                                                    @if (Session::get('website_language') == 'en')
                                                                        {{ $item['productInfo']->nameEn }}
                                                                    @else
                                                                        {{ $item['productInfo']->nameVi }}
                                                                    @endif
                                                                    <span class="mt-1"
                                                                        style="border:solid lightgray 1px;height: 13px;width: 13px;background-color: {{ $item['productInfo']->color }};border-radius: 50%;display: inline-block;"></span>
                                                                    x{{ $item['quantity'] }}
                                                                </td>
                                                                <td class="td-title-2">
                                                                    {{ number_format($item['price']) }}đ</td>
                                                            </tr>
                                                        @endforeach
                                                        <tr>
                                                            <td class="td-title-1">
                                                                {{ trans('message.cart_subtotal') }}</td>
                                                            <td class="td-title-2">
                                                                {{ number_format(Session::get('Cart')->totalPrice ?? 0) }}đ
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            @if (Session::has('Voucher'))
                                                                @if (Session::get('Voucher')->amount > 0)
                                                                    <td class="td-title-1">
                                                                        {{ trans('message.discount') }}
                                                                    </td>
                                                                    <td class="td-title-2">
                                                                        -
                                                                        {{ number_format(Session::get('Voucher')->amount) }}đ
                                                                    </td>
                                                                @else
                                                                    <td class="td-title-1">
                                                                        {{ trans('message.discount') }}
                                                                    </td>
                                                                    <td class="td-title-2">
                                                                        -
                                                                        {{ number_format(Session::get('Cart')->totalPrice - (Session::get('Cart')->totalPrice - (Session::get('Cart')->totalPrice * Session::get('Voucher')->percent) / 100)) }}đ
                                                                    </td>
                                                                @endif
                                                            @endif
                                                        </tr>
                                                        <tr>
                                                            <td class="order-total">{{ trans('message.total_order') }}
                                                            </td>
                                                            <td class="order-total-price">
                                                                @if (Session::has('Cart') != null)
                                                                    @if (Session::has('Voucher') != null)
                                                                        @if (Session::get('Voucher')->amount > 0)
                                                                            {{ number_format(Session::get('Cart')->totalPrice - Session::get('Voucher')->amount) }}đ
                                                                        @else
                                                                            {{ number_format(Session::get('Cart')->totalPrice - (Session::get('Cart')->totalPrice * Session::get('Voucher')->percent) / 100) }}đ
                                                                        @endif
                                                                    @else
                                                                        {{ number_format(Session::get('Cart')->totalPrice) ?? 0 }}đ
                                                                    @endif
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <!-- payment-method -->
                                                <div class="payment-method">
                                                    <h6 class="widget-title border-left mb-20">
                                                        {{ trans('message.payment_method') }}</h6>
                                                    <div id="accordion">
                                                        <div class="panel">
                                                            <h4 class="payment-title box-shadow payment_checked">
                                                                <a href="javascript:" id="pay_on_delivery">
                                                                    {{ trans('message.pay_on_delivery') }}
                                                                </a>
                                                            </h4>
                                                        </div>
                                                        <div class="panel">
                                                            <h4 class="payment-title box-shadow">
                                                                <a href="javascript:" id="online_payment">
                                                                    {{ trans('message.online_payment') }}
                                                                </a>
                                                            </h4>
                                                        </div>
                                                        {{-- <div class="panel">
                                                            <h4 class="payment-title box-shadow">
                                                                <a class="collapsed" data-toggle="collapse"
                                                                    data-parent="#accordion" href="#collapseTwo"
                                                                    id="pay_online">
                                                                    cheque payment
                                                                </a>
                                                            </h4>
                                                            <div id="collapseTwo" class="panel-collapse collapse">
                                                                <div class="payment-content">
                                                                    <p>Please send your cheque to Store Name, Store Street,
                                                                        Store Town, Store State / County, Store Postcode.
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div> --}}

                                                    </div>
                                                </div>
                                                <!-- payment-method end -->
                                                <button class="submit-btn-1 mt-30 btn-hover-1" id="payment-submit"
                                                    type="button">{{ trans('message.order') }}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- checkout end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- SHOP SECTION END -->

    </section><button class="btn btn-primary" id="manualTrigger">Click me</button>
    <!-- End page content -->
@endsection
@section('jsScript')
    <script>
        $().ready(function() {
            var payment_method = 1;
            $("#form-payment").validate({
                rules: {
                    "name": {
                        required: true,
                        maxlength: 45,
                        minlength: 6
                    },
                    'email': {
                        required: true,
                        email: true,
                        maxlength: 45,
                        minlength: 6,
                    },
                    'phone': {
                        required: true,
                        number: true,
                        maxlength: 10,
                        minlength: 10
                    },
                    "city": {
                        required: true,
                    },
                    "district": {
                        required: true,
                    },
                    "ward": {
                        required: true,
                    },
                    "address": {
                        required: true,
                        maxlength: 255
                    },
                },
                messages: {
                    "name": {
                        required: "{{ trans('validation.payment.name.required') }}",
                        maxlength: "{{ trans('validation.payment.name.max') }}",
                        minlength: "{{ trans('validation.payment.name.min') }}"
                    },
                    "email": {
                        required: "{{ trans('validation.payment.email.required') }}",
                        maxlength: "{{ trans('validation.payment.email.max') }}",
                        minlength: "{{ trans('validation.payment.email.min') }}",
                        email: "{{ trans('validation.payment.email.email') }}",
                    },
                    "phone": {
                        required: "{{ trans('validation.payment.phone.required') }}",
                        number: "{{ trans('validation.payment.phone.number') }}",
                        maxlength: "{{ trans('validation.payment.phone.max') }}",
                        minlength: "{{ trans('validation.payment.phone.min') }}",
                    },
                    "city": {
                        required: "{{ trans('validation.payment.city.required') }}",
                    },
                    "district": {
                        required: "{{ trans('validation.payment.district.required') }}",
                    },
                    "ward": {
                        required: "{{ trans('validation.payment.ward.required') }}",
                    },
                    "address": {
                        required: "{{ trans('validation.payment.address.required') }}",
                        maxlength: "{{ trans('validation.payment.address.max') }}",
                    },

                }
            });

            $('#payment-submit').on('click', function() {
                if ($("#form-payment").valid()) {
                    var data = {
                        'name': $("input[name='name']").val(),
                        'email': $("input[name='email']").val(),
                        'phone': $("input[name='phone']").val(),
                        'city': $("select[name='city']").val(),
                        'district': $("select[name='district']").val(),
                        'ward': $("select[name='ward']").val(),
                        'address': $("textarea[name='address']").val(),
                        'method': payment_method
                    }
                    $.confirm({
                        title: '{{ trans('message.order_confirm') }}',
                        content: '{{ trans('message.order_confirmed') }}',
                        buttons: {
                            ok: {
                                text: '{{ trans('message.order_ok') }}',
                                btnClass: 'btn-warning',
                                action: function() {
                                    if (payment_method == 2) {
                                        window.location = '/thanh-toan-online?array='+ JSON.stringify(data);
                                    } else {
                                        $.ajax({
                                            url: '/xu-ly-thanh-toan',
                                            type: 'POST',
                                            data: {
                                                '_token': "{{ csrf_token() }}",
                                                'data': data
                                            }
                                        }).done(function(response) {
                                            if (response) {
                                                window.location =
                                                    '/hoan-thanh-dat-hang/' +
                                                    response;
                                                alertify.success(
                                                    '{{ trans('message.order_success') }}'
                                                );
                                            } else {
                                                alertify.error(
                                                    '{{ trans('message.order_failed') }}'
                                                );
                                            }
                                        })
                                    }

                                }
                            },
                            close: {
                                text: '{{ trans('message.order_close') }}',
                            }
                        }
                    });
                }
            })

            $('#pay_on_delivery').on('click', function() {
                $(this).parent().addClass('payment_checked');
                $('#online_payment').parent().removeClass('payment_checked');
                payment_method = 1;
            });

            $('#online_payment').on('click', function() {
                $(this).parent().addClass('payment_checked');
                $('#pay_on_delivery').parent().removeClass('payment_checked');
                payment_method = 2;
            });



        });

        function changeCity(code) {
            $.ajax({
                url: '/getDistrict/' + code.value,
                type: 'GET',
            }).done(function(response) {
                $.ajax({
                    url: '/getShipFee/' + code.value,
                    type: 'GET',
                }).done(function(response) {
                    $('#payment_order').empty()
                    $('#payment_order').html(response);
                })
                $('#payment_district').empty()
                $('#payment_district').html(response);
            })
        }

        function changeDistrict(code) {
            $.ajax({
                url: '/getWard/' + code.value,
                type: 'GET',
            }).done(function(response) {
                $('#payment_ward').empty()
                $('#payment_ward').html(response);
            })
        }
    </script>
@endsection
