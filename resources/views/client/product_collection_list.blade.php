@extends('client.layout')
@section('title', trans('message.product_list'))
@section('main')
    <!-- BREADCRUMBS SETCTION START -->
    <div class="breadcrumbs-section plr-200 mb-80">
        <div class="breadcrumbs overlay-bg">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="breadcrumbs-inner">
                            <h1 class="breadcrumbs-title">{{ trans('message.product_list') }}</h1>
                            <ul class="breadcrumb-list">
                                <li><a href="{{ route('homeClient') }}">{{ trans('message.home') }}</a></li>
                                <li>{{ trans('message.product_list') }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BREADCRUMBS SETCTION END -->

    <!-- Start page content -->
    <div id="page-content" class="page-wrapper">

        <!-- SHOP SECTION START -->
        <div class="shop-section mb-80">
            <div class="container">
                <div class="row">
                    <div class="col-md-9 col-md-push-3 col-xs-12">
                        <div class="shop-content">
                            <!-- shop-option start -->
                            <div class="shop-option box-shadow mb-30 clearfix">
                                <!-- Nav tabs -->
                                <ul class="shop-tab f-left" role="tablist">
                                    <li class="active">
                                        <a href="#grid-view" data-toggle="tab"><i class="zmdi zmdi-view-module"></i></a>
                                    </li>
                                </ul>
                                <!-- short-by -->
                                @include('client.formToSort')
                                <!-- showing -->
                                <div class="showing f-right text-right">
                                    @if (!$products->isEmpty())
                                        <span>{{ trans('message.show') }}:{{ $products->firstItem() }} -
                                            {{ $products->lastItem() }} {{ trans('message.of') }}
                                            {{ $products->total() }}.</span>
                                    @endif
                                </div>
                            </div>
                            <!-- shop-option end -->
                            <!-- Tab Content start -->
                            <div class="tab-content">
                                <!-- grid-view -->
                                <div role="tabpanel" class="tab-pane active" id="grid-view">
                                    <div class="row">
                                        <!-- product-item start -->
                                        @if (!$products->isEmpty())
                                            @foreach ($products as $product)
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                    <div class="product-item">
                                                        <div class="product-img">
                                                            <a href="{{ route('productDetail', $product->id) }}">
                                                                <img src="{{ asset($product->image) }}"
                                                                    onerror="this.src='{{ asset('img/empty.png') }}'"
                                                                    alt="" />
                                                            </a>
                                                        </div>
                                                        <div class="product-info">
                                                            <h6 class="product-title">
                                                                <a href="">
                                                                    @if (Session::get('website_language') == 'en')
                                                                        {{ $product->name_en ?? $product->name_vi }}
                                                                    @else
                                                                        {{ $product->name_vi }}
                                                                    @endif
                                                            </h6>
                                                            <div class="pro-rating">
                                                                <?= Helper::instance()->stars_averaged($product->id) ?>
                                                            </div>
                                                            <div>
                                                                @foreach ($product->details as $item)
                                                                    <a href="#color1" data-toggle="tab"><span class="mt-1"
                                                                            style="border:solid lightgray 1px;height: 13px;width: 13px;background-color: {{ $item->colors->code }};border-radius: 50%;display: inline-block;"></span></a>
                                                                @endforeach
                                                            </div>
                                                            <h3 class="pro-price">
                                                                <div class="s-price-box" style="border:none; padding:0">
                                                                    @if ($product->discount > 0)
                                                                        <span
                                                                            class="new-price">{{ number_format($product->price - ($product->price * $product->discount) / 100) }}đ</span>
                                                                        <span
                                                                            class="old-price">{{ number_format($product->price) }}đ</span>
                                                                    @else <span
                                                                            class="new-price">{{ number_format($product->price) }}đ</span>
                                                                    @endif
                                                                </div>
                                                            </h3>
                                                            <ul class="action-button">
                                                                <li>
                                                                    <a href="#" data-toggle="modal"
                                                                        data-target="#ProductModal{{ $product->id }}"
                                                                        title="{{ trans('message.quick_view') }}"><i
                                                                            class="zmdi zmdi-zoom-in"></i></a>
                                                                </li>
                                                                <li>
                                                                    <a href="{{ route('productDetail', $product->id) }}"
                                                                        title="{{ trans('message.buy_now') }}"><i
                                                                            class="zmdi zmdi-shopping-cart-plus"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else <div class="col-md-12 col-sm-12 col-xs-12 text-center">{{ trans('message.products_empty') }}</div>
                                        @endif

                                        <!-- product-item end -->
                                    </div>
                                </div>
                            </div>
                            <!-- Tab Content end -->
                            <!-- shop-pagination start -->
                            <div class="text-center">
                                {{ $products->appends(request()->query())->links() }}
                            </div>
                            <!-- shop-pagination end -->
                        </div>
                    </div>
                    <div class="col-md-3 col-md-pull-9 col-xs-12">
                        <!-- widget-search -->
                        {{-- <aside class="widget-search mb-30">
                            <form action="#">
                                <input type="text" placeholder="Tìm kiếm...">
                                <button type="submit"><i class="zmdi zmdi-search"></i></button>
                            </form>
                        </aside> --}}
                        <!-- widget-collections -->
                        <aside class="widget widget-collections box-shadow mb-30">
                            <h6 class="widget-title border-left mb-20">{{ trans('message.collection') }}</h6>
                            <div>
                                <ul>
                                    @foreach ($collections as $collection)
                                        <li>
                                            <a style="{{ $collection->id == request()->route('id') ? 'color:#ff7f00' : '' }}"
                                                href="{{ route('productsByCollection', $collection->id) }}">
                                                @if (Session::get('website_language') == 'en')
                                                    {{ $collection->name_en ?? $collection->name_vi }}
                                                @else
                                                    {{ $collection->name_vi }}
                                                @endif
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </aside>
                        <!-- shop-filter -->
                        @include('client.widgetFilter')
                    </div>
                </div>
            </div>
        </div>
        <!-- SHOP SECTION END -->
    </div>
    <!-- MODAL -->
    @include('client.modal', ['name'=>'ProductModal','items'=>$products ])
    <!-- End page content -->
@endsection
@section('jsScript')
    <script>
        $(document).ready(function() {
            $("input:checkbox").change(
                function() {
                    $("#checkboxPrice").submit();
                }
            )
            $("#selectToSort").change(function() {
                $("#formToSort").submit();
            })
        });
    </script>
@endsection
