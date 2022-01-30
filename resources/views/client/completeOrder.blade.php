@extends('client.layout')
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
                                <a href="javascript:" style="color: #ff7f00">
                                    <span style="border: 1px solid; color: #ff7f00">01</span>
                                    {{ trans('message.cart') }}
                                </a>
                            </li>
                            <li>
                                <a href="javascript:" style="color: #ff7f00">
                                    <span style="border: 1px solid">02</span>
                                    {{ trans('message.payment') }}
                                </a>
                            </li>
                            <li>
                                <a class="active" href="#order-complete" data-toggle="tab" style="color: #ff7f00">
                                    <span style="border: 1px solid">03</span>
                                    {{ trans('message.successfully') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-10 col-sm-12">
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <!-- order-complete start -->
                            <div class="tab-pane active" id="order-complete">
                                <div class="order-complete-content box-shadow">
                                    <div class="thank-you p-30 text-center">
                                        <h6 class="text-black-5 mb-0">{{ trans('message.thanks_for_order') }}</h6>
                                    </div>
                                    <div class="order-info p-30 mb-10">
                                        <ul class="order-info-list">
                                            <li>
                                                <h6>{{ trans('message.order_no') }}</h6>
                                                <p>m {{ $order['id'] }}</p>
                                            </li>
                                            <li>
                                                <h6>{{ trans('message.order_at') }}</h6>
                                                <p>{{ date('d-m-Y H:i:s', strtotime($order['created_at'])) }}</p>
                                            </li>
                                            <li>
                                                <h6>{{ trans('message.payment_method') }}</h6>
                                                <p>{{ $order['method'] == 1 ? trans('message.pay_on_delivery') : trans('message.online_payment') }}
                                                </p>
                                            </li>
                                            <li>
                                                <h6>{{ trans('message.status') }}</h6>
                                                <p>{{ trans('message.status_show.' . $order['status']) }}
                                                </p>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="row">
                                        <!-- our order -->
                                        <div class="col-md-6">
                                            <div class="payment-details p-30">
                                                <h6 class="widget-title border-left mb-20">
                                                    {{ trans('message.order_details') }}</h6>
                                                <table>
                                                    <?php $cart_subtotal = 0; ?>
                                                    @foreach ($order['order_details'] as $item)
                                                        <?php
                                                        $cart_subtotal += $item['price'];
                                                        ?>
                                                        <tr>
                                                            <td class="td-title-1">
                                                                @if (Session::get('website_language') == 'en')
                                                                    {{ $item['info']->nameEn }}
                                                                @else
                                                                    {{ $item['info']->nameVi }}
                                                                @endif
                                                                <span class="mt-1"
                                                                    style="border:solid lightgray 1px;height: 13px;width: 13px;background-color: {{ $item['info']->color }};border-radius: 50%;display: inline-block;"></span>
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
                                                            {{ number_format($cart_subtotal) }}đ
                                                        </td>
                                                    </tr>

                                                    @if ($order['vouchers'])
                                                        <tr>
                                                            @if ($order['vouchers']['amount'] > 0)
                                                                <td class="td-title-1">
                                                                    {{ trans('message.discount') }}
                                                                </td>
                                                                <td class="td-title-2">
                                                                    -
                                                                    {{ number_format($order['vouchers']['amount']) }}đ
                                                                </td>
                                                            @else
                                                                <td class="td-title-1">
                                                                    {{ trans('message.discount') }}
                                                                </td>
                                                                <td class="td-title-2">
                                                                    {{ number_format($order['price'] - ($order['price'] + ($order['price'] * $order['vouchers']['percent']) / 100)) }}đ
                                                                </td>
                                                            @endif
                                                        </tr>
                                                    @endif

                                                    @if ($order['city'] != 'Hồ Chí Minh')
                                                        <tr>
                                                            <td class="td-title-1">
                                                                {{ trans('message.ship') }}
                                                            </td>
                                                            <td class="td-title-2">
                                                                + 100,000 đ
                                                            </td>
                                                        </tr>
                                                    @endif
                                                    <tr>
                                                        <td class="order-total">{{ trans('message.total_order') }}
                                                        </td>
                                                        <td class="order-total-price">
                                                            {{ number_format($order['price']) }}đ</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="bill-details p-30">
                                                <h6 class="widget-title border-left mb-20">
                                                    {{ trans('message.billing_details') }}</h6>
                                                <ul class="bill-address">
                                                    <li>
                                                        <span>{{ trans('message.name') }}:</span>
                                                       {{ $order['name'] }}
                                                       
                                                    </li>
                                                    <li>
                                                        <span>{{ trans('message.address') }}:</span>
                                                        {{ $order['address'] }}
                                                    </li>
                                                    <li>
                                                        <span>Email:</span>
                                                        {{ $order['email'] }}
                                                    </li>
                                                    <li>
                                                        <span>{{ trans('message.phone') }} : </span>
                                                        {{ $order['phone'] }}
                                                    </li>
                                                </ul>
                                            </div>
                                            @if (isset($payment))
                                                <div class="bill-details p-30">
                                                    <h6 class="widget-title border-left mb-20">
                                                        {{ trans('message.payment_details') }}</h6>
                                                    <ul class="bill-address">
                                                        <li>
                                                            <span>{{ trans('message.tran_code') }}:</span>
                                                            {{ $payment->trade_code }}
                                                        </li>
                                                        <li>
                                                            <span>{{ trans('message.bank_pay_code') }}:</span>
                                                            {{ $payment->bank_pay_code }}
                                                        </li>
                                                        <li>
                                                            <span>{{ trans('message.tran_date') }}:</span>
                                                            {{ date('d-m-Y H:i:s', strtotime($payment->trade_date)) }}
                                                        </li>
                                                        <li>
                                                            <span>{{ trans('message.payment_type') }} : </span>
                                                            {{ $payment->type }}
                                                        </li>
                                                    </ul>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- order-complete end -->
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
                                    $.ajax({
                                        url: '/xu-ly-thanh-toan',
                                        type: 'POST',
                                        data: {
                                            '_token': "{{ csrf_token() }}",
                                            'data': data
                                        }
                                    }).done(function(response) {
                                        if (response) {
                                            window.location = '/hoan-thanh-dat-hang/' +
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
