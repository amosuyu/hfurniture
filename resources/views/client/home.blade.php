@extends('client.layout')
@section('title', trans('message.home') )
@section('main')
    <!-- START SLIDER AREA -->
    <div class="slider-area  plr-185  mb-80">
        <div class="container-fluid">
            <div class="slider-content">
                <div class="row">
                    <div class="active-slider-1 slick-arrow-1 slick-dots-1">
                        @foreach ($newProducts as $newProduct)
                            <!-- layer-1 Start -->
                            <div class="col-md-12">
                                <div class="layer-1">
                                    <div class="slider-img">
                                        <img src="{{ asset($newProduct->image) }}"
                                            onerror="this.src='{{ asset('img/empty.png') }}'" alt="">
                                    </div>
                                    <div class="slider-info gray-bg">
                                        <div class="slider-info-inner">
                                            <h1 class="slider-title-1 text-uppercase text-black-1">
                                                @if(Session::get('website_language') == 'en')
                                                {{ $newProduct->name_en ?? $newProduct->name_vi }}
                                                @else
                                                {{ $newProduct->name_vi }}
                                                @endif
                                            </h1>
                                            <div class="slider-brief text-black-2">
                                                <p>
                                                @if(Session::get('website_language') == 'en')
                                                {{ $newProduct->description_en ?? $newProduct->description_vi }}
                                                @else
                                                {{ $newProduct->description_vi }}
                                                @endif
                                            </p>
                                            </div>
                                            <a href="{{ route('productDetail', $newProduct->id) }}"
                                                class="button extra-small button-black">
                                                <span class="text-uppercase">{{ trans('message.buy_now') }}</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- layer-1 end -->
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END SLIDER AREA -->
    <!-- Start page content -->
    <section id="page-content" class="page-wrapper">

        <!-- BY BRAND SECTION START-->
        <div class="by-brand-section mb-80">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title text-left mb-40">
                            <h2 class="uppercase">{{ trans('message.collection') }}</h2>
                            <h6>{{ trans('message.collection_description') }}</h6>
                        </div>
                    </div>
                </div>
                <div class="by-brand-product">
                    <div class="row active-by-brand slick-arrow-2">
                        @foreach ($collections as $collection)
                            <div class="col-xs-12" style="width: 400px !important">
                                <div class="single-brand-product">
                                    <a href="{{ route('productsByCollection', $collection->id) }}"><img
                                            style="height: 160px" src="{{ asset($collection->image) }}"
                                            onerror="this.src='{{ asset('img/empty.png') }}'" alt=""></a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- BY BRAND SECTION END -->

        <!-- FEATURED PRODUCT SECTION START -->
        <div class="featured-product-section mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title text-left mb-40">
                            <h2 class="uppercase">{{ trans('message.featured_products') }}</h2>
                            <h6>{{ trans('message.featured_products_description') }}</h6>
                        </div>
                    </div>
                </div>
                <div class="featured-product">
                    <div class="row active-featured-product slick-arrow-2">
                        <!-- product-item start -->
                        @foreach ($hotProducts as $hotProduct)
                            <div class="col-xs-12">
                                <div class="product-item">
                                    <div class="product-img">
                                        <a href="{{ route('productDetail', $hotProduct->id) }}">
                                            <img src="{{ asset($hotProduct->image) }}"
                                                onerror="this.src='{{ asset('img/empty.png') }}'" alt="" />
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <h6 class="product-title">
                                            <a
                                                href="{{ route('productDetail', $hotProduct->id) }}">
                                                @if(Session::get('website_language') == 'en')
                                                {{ $hotProduct->name_en ?? $hotProduct->name_vi }}
                                                @else
                                                {{ $hotProduct->name_vi }}
                                                @endif
                                        </h6>
                                        <div class="pro-rating">
                                            <?= Helper::instance()->stars_averaged($hotProduct->id) ?>
                                        </div>
                                        <div>
                                            @foreach ($hotProduct->details as $item)
                                                <a href="#color1" data-toggle="tab"><span class="mt-1"
                                                        style="border:solid lightgray 1px;height: 13px;width: 13px;background-color: {{ $item->colors->code }};border-radius: 50%;display: inline-block;"></span></a>
                                            @endforeach
                                        </div>
                                        <h3 class="pro-price">
                                            <div class="s-price-box" style="border:none; padding:0">
                                                @if ($hotProduct->discount > 0)
                                                    <span
                                                        class="new-price">{{ number_format($hotProduct->price - ($hotProduct->price * $hotProduct->discount) / 100) }}đ</span>
                                                    <span
                                                        class="old-price">{{ number_format($hotProduct->price) }}đ</span>
                                                @else <span
                                                        class="new-price">{{ number_format($hotProduct->price) }}đ</span>
                                                @endif
                                            </div>
                                        </h3>
                                        <ul class="action-button">
                                            <li>
                                                <a href="#" data-toggle="modal"
                                                    data-target="#hotProductModal{{ $hotProduct->id }}"
                                                    title="{{ trans('message.quick_view') }}"><i class="zmdi zmdi-zoom-in"></i></a>
                                            </li>
                                            <li>
                                                <a href="{{ route('productDetail', $hotProduct->id) }}" title="{{ trans('message.buy_now') }}"><i
                                                        class="zmdi zmdi-shopping-cart-plus"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <!-- product-item end -->
                    </div>
                </div>
            </div>
        </div>
        <!-- FEATURED PRODUCT SECTION END -->

        <!-- PRODUCT TAB SECTION START -->
        <div class="product-tab-section mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="section-title text-left mb-40">
                            <h2 class="uppercase">{{ trans('message.product_list') }}</h2>
                            <h6>{{ trans('message.product_list_description') }}</h6>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="pro-tab-menu text-right">
                            <!-- Nav tabs -->
                            <ul class="">
                                <li class="active"><a href="#selling-product" data-toggle="tab">{{ trans('message.selling_product') }}
                                    </a></li>
                                <li><a href="#best-deal" data-toggle="tab">{{ trans('message.big_sale') }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="product-tab">
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <!-- selling-product start -->
                        <div class="tab-pane active" id="selling-product">
                            <div class="row">
                                @foreach ($sellingProducts as $sellingProduct)
                                    <!-- product-item start -->
                                    <div class="col-md-3 hidden-sm col-xs-12">
                                        <div class="product-item">
                                            <div class="product-img">
                                                <a href="{{ route('productDetail', $sellingProduct->id) }}">
                                                    <img src="{{ asset($sellingProduct->image) }}"
                                                        onerror="this.src='{{ asset('img/empty.png') }}'" alt="" />
                                                </a>
                                            </div>
                                            <div class="product-info">
                                                <h6 class="product-title">
                                                    <a
                                                        href="{{ route('productDetail', $sellingProduct->id) }}">
                                                        @if(Session::get('website_language') == 'en')
                                                        {{ $sellingProduct->name_en ?? $sellingProduct->name_vi }}
                                                        @else
                                                        {{ $sellingProduct->name_vi }}
                                                        @endif
                                                </h6>
                                                <div class="pro-rating">
                                                    <?= Helper::instance()->stars_averaged($sellingProduct->id) ?>
                                                </div>
                                                <div>
                                                    @foreach ($sellingProduct->details as $item)
                                                        <a href="#color1" data-toggle="tab"><span class="mt-1"
                                                                style="border:solid lightgray 1px;height: 13px;width: 13px;background-color: {{ $item->colors->code }};border-radius: 50%;display: inline-block;"></span></a>
                                                    @endforeach
                                                </div>
                                                <p style="font-family: 'Roboto', sans-serif;">
                                                    @if ($sellingProduct->discount > 0)
                                                        <span
                                                            style="color: #666;font-size: 20px;font-weight: bold;margin-right: 10px}">{{ number_format($sellingProduct->price - ($sellingProduct->price * $sellingProduct->discount) / 100) }}đ</span>
                                                        <span class="old-price"
                                                            style="color: #a6a6a6;font-size: 15px;text-decoration: line-through;">{{ number_format($sellingProduct->price) }}đ</span>
                                                    @else <span
                                                            style="color: #666;font-size: 20px;font-weight: bold;margin-right: 10px}">{{ number_format($sellingProduct->price) }}đ</span>
                                                    @endif
                                                </p>

                                                <ul class="action-button">
                                                    <li>
                                                        <a href="#" data-toggle="modal"
                                                            data-target="#sellingProductModal{{ $sellingProduct->id }}"
                                                            title="{{ trans('message.quick_view') }}"><i class="zmdi zmdi-zoom-in"></i></a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('productDetail', $sellingProduct->id) }}" title="{{ trans('message.buy_now') }}"><i
                                                                class="zmdi zmdi-shopping-cart-plus"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- product-item end -->
                                @endforeach
                            </div>
                        </div>
                        <!-- selling-product end -->
                        <!-- best-deal start -->
                        <div class="tab-pane" id="best-deal">
                            <div class="row">
                                @foreach ($bestDealProducts as $bestDealProduct)
                                    <!-- product-item start -->
                                    <div class="col-md-3 hidden-sm col-xs-12">
                                        <div class="product-item">
                                            <div class="product-img">
                                                <a href="{{ route('productDetail', $bestDealProduct->id) }}">
                                                    <img src="{{ asset($bestDealProduct->image) }}"
                                                        onerror="this.src='{{ asset('img/empty.png') }}'" alt="" />
                                                </a>
                                            </div>
                                            <div class="product-info">
                                                <h6 class="product-title">
                                                    <a
                                                        href="{{ route('productDetail', $bestDealProduct->id) }}">
                                                        @if(Session::get('website_language') == 'en')
                                                        {{ $bestDealProduct->name_en ?? $bestDealProduct->name_vi }}
                                                        @else
                                                        {{ $bestDealProduct->name_vi }}
                                                        @endif
                                                </h6>
                                                <div class="pro-rating">
                                                    <?= Helper::instance()->stars_averaged($bestDealProduct->id) ?>
                                                </div>
                                                <div>
                                                    @foreach ($bestDealProduct->details as $item)
                                                        <a href="#color1" data-toggle="tab"><span class="mt-1"
                                                                style="border:solid lightgray 1px;height: 13px;width: 13px;background-color: {{ $item->colors->code }};border-radius: 50%;display: inline-block;"></span></a>
                                                    @endforeach
                                                </div>
                                                <h3 class="pro-price">
                                                    <div class="s-price-box" style="border:none; padding:0">
                                                        @if ($bestDealProduct->discount > 0)
                                                            <span
                                                                class="new-price">{{ number_format($bestDealProduct->price - ($bestDealProduct->price * $bestDealProduct->discount) / 100) }}đ</span>
                                                            <span
                                                                class="old-price">{{ number_format($bestDealProduct->price) }}đ</span>
                                                        @else <span
                                                                class="new-price">{{ number_format($bestDealProduct->price) }}đ</span>
                                                        @endif
                                                    </div>
                                                </h3>
                                                <ul class="action-button">
                                                    <li>
                                                        <a href="#" data-toggle="modal"
                                                            data-target="#dealProductModal{{ $bestDealProduct->id }}"
                                                            title="{{ trans('message.quick_view') }}"><i class="zmdi zmdi-zoom-in"></i></a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('productDetail', $bestDealProduct->id) }}" title="{{ trans('message.buy_now') }}"><i
                                                                class="zmdi zmdi-shopping-cart-plus"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- product-item end -->
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- PRODUCT TAB SECTION END -->

        <!-- BLOG SECTION START -->
        <div class="blog-section mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title text-left mb-40">
                            <h2 class="uppercase">{{ trans('message.latest_news') }}</h2>
                            <h6>{{ trans('message.latest_news_description') }}</h6>
                        </div>
                    </div>
                </div>
                <div class="blog">
                    <div class="row active-blog">
                        <!-- blog-item start -->
                        @foreach ($blogs as $blog)
                            <div class="col-xs-12">
                                <div class="blog-item">
                                    <img src="{{ asset($blog->image) }}"
                                        onerror="this.src='{{ asset('img/empty.png') }}'" alt="">
                                    <div class="blog-desc">
                                        <h5 class="blog-title"><a
                                                href="{{ route('blogDetail', $blog->id) }}">{{ $blog->title }}</a>
                                        </h5>
                                        <p>{{ $blog->description }}</p>
                                        <div class="read-more">
                                            <a href="{{ route('blogDetail', $blog->id) }}">{{ trans('message.more') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <!-- blog-item end -->
                    </div>
                </div>
            </div>
        </div>
        <!-- BLOG SECTION END -->
    </section>
    <!-- End page content -->
    <!-- START QUICKVIEW PRODUCT -->
    <div id="quickview-wrapper">
        <!-- Modal -->
        @include('client.modal', ['name'=> 'hotProductModal', 'items' => $hotProducts])
        @include('client.modal', ['name'=> 'sellingProductModal', 'items' => $sellingProducts])
        @include('client.modal', ['name'=> 'dealProductModal', 'items' => $bestDealProducts])

        <!-- END Modal -->
    </div>
    <!-- END QUICKVIEW PRODUCT -->
@endsection
