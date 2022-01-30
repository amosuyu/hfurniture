<!-- START HEADER AREA -->
<header class="header-area header-wrapper">
    <!-- header-top-bar -->
    <div class="header-top-bar plr-185">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6 hidden-xs">
                    <div class="call-us">
                        <p class="mb-0 roboto">(+84)902595423</p>
                    </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <div class="top-link clearfix">
                        <ul class="link f-right">
                            @guest
                                <li>
                                    <a href="{{ route('loginClient') }}">
                                        <i class="zmdi zmdi-account"></i>
                                        {{ trans('message.my_account') }}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('loginClient') }}">
                                        <i class="zmdi zmdi-lock"></i>
                                        {{ trans('message.login') }}
                                    </a>
                                </li>
                            @endguest
                            @auth
                                <li>
                                    <a href="{{ route('information') }}">
                                        <i class="zmdi zmdi-account"></i>
                                        {{ Auth::user()->name }}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('handleLogout') }}">
                                        <i class="zmdi zmdi-sign-in"></i>
                                        {{ trans('message.logout') }}
                                    </a>
                                </li>
                            @endauth
                            <li>
                                @if (Session::has('website_language'))
                                    @if (Session::get('website_language') == 'en')
                                        <a style="width: 50px;font-size: 18px;line-height: 1"
                                            href="{!! route('changeLanguage', ['vn']) !!}"><img src="{{ asset('img') }}/flag-vi.png"
                                                alt=""></a>
                                    @else
                                        <a style="width: 50px;font-size: 18px;line-height: 1"
                                            href="{!! route('changeLanguage', ['en']) !!}"><img src="{{ asset('img') }}/flag-en.png"
                                                alt=""></a>
                                    @endif
                                @else <a style="width: 50px;font-size: 18px;line-height: 1"
                                        href="{!! route('changeLanguage', ['en']) !!}"><img src="{{ asset('img') }}/flag-en.png"
                                            alt=""></a>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- header-middle-area -->
    <div id="sticky-header" class="header-middle-area plr-185">
        <div class="container-fluid">
            <div class="full-width-mega-dropdown">
                <div class="row">
                    <!-- logo -->
                    <div class="col-md-2 col-sm-6 col-xs-12">
                        <div class="logo">
                            <a href="{{ route('homeClient') }}">
                                <img src="{{ asset('client/img') }}/logo/logo.png" style="max-width:150px"
                                    alt="main logo">
                            </a>
                        </div>
                    </div>
                    <!-- primary-menu -->
                    @include('client.menu')
                    <!-- header-search & total-cart -->
                    <div class="col-md-2 col-sm-6 col-xs-12">
                        <div class="search-top-cart  f-right">
                            <!-- header-search -->
                            <div class="header-search f-left">
                                <div class="header-search-inner">
                                    <button class="search-toggle">
                                        <i class="zmdi zmdi-search"></i>
                                    </button>
                                    <div class="top-search-box">
                                        <input id="searchProduct" name="searchProduct" type="text"
                                            placeholder="{{ trans('message.search_product') }}">
                                        <div style="background-color: white">
                                            <table id="previewProducts" class="table" style="color: black; font-size:16px">
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- total-cart -->
                            <div class="total-cart f-left">
                                <div class="total-cart-in">
                                    <div class="cart-toggler">
                                        <a href="#">
                                            <span class="cart-quantity">
                                                @if (Session::has('Cart') != null)
                                                    <span
                                                        id="total-quantity-show">{{ Session::get('Cart')->totalQuantity }}</span>
                                                @else <span id="total-quantity-show">0</span>
                                                @endif
                                            </span><br>
                                            <span class="cart-icon">
                                                <i class="zmdi zmdi-shopping-cart-plus"></i>
                                            </span>
                                        </a>
                                    </div>
                                    <ul id="change-item-cart">
                                        <li>
                                            <div class="top-cart-inner your-cart">
                                                <h5 class="text-capitalize">{{ trans('message.my_cart') }}</h5>
                                            </div>
                                        </li>
                                        @if (Session::has('Cart') != null)
                                            <li style="max-height: 350px; overflow:scroll">
                                                <div class="total-cart-pro">
                                                    <!-- single-cart -->
                                                    @foreach (Session::get('Cart')->products as $item)
                                                        <div class="single-cart clearfix">
                                                            <div class="cart-img f-left" style="width:35%">
                                                                <a
                                                                    href="{{ route('productDetail', $item['productInfo']->product_id) }}">
                                                                    <img src="{{ asset($item['productInfo']->image) }}"
                                                                        onerror="this.src='{{ asset('img/empty.png') }}'"
                                                                        alt="Cart Product" style="width:100%" />
                                                                </a>
                                                                <div class="del-icon">
                                                                    <a href="javascript:">
                                                                        <i class="zmdi zmdi-close"
                                                                            data-id="{{ $item['productInfo']->id }}"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="cart-info f-left"
                                                                style="width:65%; padding-top:0px">
                                                                <h6 class="text-capitalize">
                                                                    <a
                                                                        href="{{ route('productDetail', $item['productInfo']->product_id) }}">
                                                                        @if (Session::get('website_language') == 'en')
                                                                            {{ $item['productInfo']->nameEn }}
                                                                        @else
                                                                            {{ $item['productInfo']->nameVi }}
                                                                        @endif
                                                                    </a>
                                                                </h6>
                                                                <p>
                                                                    <span>{{ trans('message.color') }}</span>
                                                                    <span class="mt-1"
                                                                        style="border:solid lightgray 1px;height: 13px;width: 13px;background-color: {{ $item['productInfo']->color }};border-radius: 50%;display: inline-block;"></span>
                                                                </p>
                                                                <p>
                                                                    <span>{{ trans('message.price') }}
                                                                        <strong>:</strong></span>{{ number_format($item['productInfo']->price) }}đ
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
                                                        {{ trans('message.total') }} =
                                                        <span>{{ number_format(Session::get('Cart')->totalPrice) }}đ</span>
                                                    </h4>
                                                </div>
                                            </li>
                                        @else
                                            <li>
                                                <div class="total-cart-pro">
                                                    <!-- single-cart -->
                                                    <div class="single-cart clearfix">
                                                        <div class="cart-info">
                                                            <h6 class="text-capitalize">
                                                                {{ trans('message.cart_empty') }}
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endif
                                        <li>
                                            <div class="top-cart-inner view-cart">
                                                <h4 class="text-uppercase">
                                                    <a
                                                        href="{{ route('listCart') }}">{{ trans('message.view_cart') }}</a>
                                                </h4>
                                            </div>
                                        </li>
                                        @if (Session::has('Cart'))
                                            <li>
                                                <div class="top-cart-inner check-out">
                                                    <h4 class="text-uppercase">
                                                        <a
                                                            href="{{ route('payment') }}">{{ trans('message.payment') }}</a>
                                                    </h4>
                                                </div>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- END HEADER AREA -->

@include('client.menuMobie')
