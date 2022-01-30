@if (Session::has('Cart') != null)
    <li>
        <div class="top-cart-inner your-cart">
            <h5 class="text-capitalize">{{ trans('message.my_cart') }}</h5>
        </div>
    </li>
    <li style="max-height: 350px; overflow:scroll">
        <div class="total-cart-pro">
            <!-- single-cart -->
            @foreach (Session::get('Cart')->products as $item)
                <div class="single-cart clearfix">
                    <div class="cart-img f-left" style="width:35%">
                        <a href="{{ route('productDetail', $item['productInfo']->product_id) }}">
                            <img src="{{ asset($item['productInfo']->image) }}"
                                onerror="this.src='{{ asset('img/empty.png') }}'" alt="Cart Product"
                                style="width:100%" />
                        </a>
                        <div class="del-icon">
                            <a href="javascript:">
                                <i class="zmdi zmdi-close" data-id="{{ $item['productInfo']->id }}"></i>
                            </a>
                        </div>
                    </div>
                    <div class="cart-info f-left" style="width:65%; padding-top:0px">
                        <h6 class="text-capitalize">
                            <a href="{{ route('productDetail', $item['productInfo']->product_id) }}">
                                @if (Session::get('website_language') == 'en')
                                    {{ $item['productInfo']->nameEn }}
                                @else
                                    {{ $item['productInfo']->nameVi }}
                                @endif
                            </a>
                        </h6>
                        <p>
                            <span>{{ trans('message.color') }}</span> <span class="mt-1"
                                style="border:solid lightgray 1px;height: 13px;width: 13px;background-color: {{ $item['productInfo']->color }};border-radius: 50%;display: inline-block;"></span>
                        </p>
                        <p>
                            <span>{{ trans('message.price') }}
                                <strong>:</strong></span>{{ number_format($item['productInfo']->price - ($item['productInfo']->price * $item['productInfo']->discount) / 100) }}đ
                            x
                            {{ $item['quantity'] }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </li>
    <li>
        <div class="top-cart-inner subtotal">
            <h4 class="text-uppercase g-font-2">
                Tổng cộng =
                <span>{{ number_format(Session::get('Cart')->totalPrice) }}đ</span>
            </h4>
        </div>
    </li>
    <li>
        <div class="top-cart-inner view-cart">
            <h4 class="text-uppercase">
                <a href="{{ route('listCart') }}">{{ trans('message.view_cart') }}</a>
            </h4>
        </div>
    </li>
    @if (Session::has('Cart'))
        <li>
            <div class="top-cart-inner check-out">
                <h4 class="text-uppercase">
                    <a href="{{ route('payment') }}">{{ trans('message.payment') }}</a>
                </h4>
            </div>
        </li>
    @endif
    <input id="total-quantity-cart" type="hidden" value="{{ Session::get('Cart')->totalQuantity }}">
@endif
