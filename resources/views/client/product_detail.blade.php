@extends('client.layout')
@section('css')
    <style>
        .content img {
            max-width: 100%;
        }


        .rating-list li {
            float: right;
            color: #ddd;
            padding: 0px 3px;
        }

        .rating-list li:hover,
        .rating-list li:hover~li {
            cursor: pointer;
            color: #ffd700;
        }

        .rating-list {
            display: inline-block;
            list-style: none;
        }

    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection
@section('title', trans('message.product_detail'))
@section('main')
    <!-- BREADCRUMBS SETCTION START -->
    <div class="breadcrumbs-section plr-200 mb-80">
        <div class="breadcrumbs overlay-bg">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="breadcrumbs-inner">
                            <h1 class="breadcrumbs-title">{{ trans('message.product_detail') }}</h1>
                            <ul class="breadcrumb-list">
                                <li><a href="{{ route('homeClient') }}">{{ trans('message.home') }}</a></li>
                                <li>{{ trans('message.product_detail') }}</li>
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
                    <div class="col-md-9 col-xs-12">
                        <!-- single-product-area start -->
                        <div class="single-product-area mb-80">
                            <div class="row">
                                <!-- imgs-zoom-area start -->
                                <div class="col-md-5 col-sm-5 col-xs-12">
                                    <div class="imgs-zoom-area">
                                        <img id="previewImg" src="{{ asset($product->image) }}"
                                            onerror="this.src='{{ asset('img/empty.png') }}'">
                                        @foreach ($product->details as $key => $detail)
                                            <div class="class-change-color tabColor{{ $detail->id }}">
                                                <div class="row mt-20">
                                                    <div class="col-xs-12">
                                                        <div class="row">
                                                            @php
                                                                $images = explode(',', rtrim($detail->images, ','));
                                                            @endphp
                                                            @foreach ($images as $image)
                                                                @if ($loop->index < 4)
                                                                <div class="col-xs-3">
                                                                    <div class="product-item"
                                                                        data-value="{{ asset($image) }}">
                                                                        <img class="zoom_03"
                                                                            src="{{ asset($image) }}"
                                                                            onerror="this.src='{{ asset('img/empty.png') }}'"
                                                                            alt="">
                                                                    </div>
                                                                </div>
                                                                @endif

                                                            @endforeach
                                                            <!-- product-item end -->
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <!-- imgs-zoom-area end -->
                                <!-- single-product-info start -->
                                <div class="col-md-7 col-sm-7 col-xs-12">
                                    <div class="single-product-info">
                                        <h3 class="text-black-1">
                                            @if (Session::get('website_language') == 'en')
                                                {{ $product->name_en ?? $product->name_vi }}
                                            @else
                                                {{ $product->name_vi }}
                                            @endif
                                        </h3>
                                        <h6 class="brand-name-2">
                                            @if (Session::get('website_language') == 'en')
                                                {{ $product->collections->name_en ? $product->collections->name_en : $product->categories->name_en }}
                                            @else
                                                {{ $product->collections->name_vi ? $product->collections->name_vi : $product->categories->name_vi }}
                                            @endif

                                        </h6>
                                        <!--  hr -->
                                        <hr>
                                        <!-- single-pro-color-rating -->
                                        <div class="single-pro-color-rating clearfix">
                                            <div class="sin-pro-color f-left">
                                                <p class="color-title f-left">{{ trans('message.color') }}</p>
                                                <div>
                                                    <ul class="reviews-tab mb-20">
                                                        @foreach ($product->details as $key => $detail)
                                                            <li class=" @if ($key == 0)active @endif" style="margin-right:10px"
                                                                onclick="changeColor({{ $detail->id }})">
                                                                <a href="#color{{ $detail->color_id }}"
                                                                    data-toggle="tab"><span class="mt-1"
                                                                        style="border:solid lightgray 1px;height: 13px;width: 13px;background-color: {{ $detail->colors->code }};border-radius: 50%;display: inline-block;"></span></a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                            <input type="hidden" id="valueByColor"
                                                value="{{ $product->details[0]->id }}">
                                            <div class="pro-rating sin-pro-rating f-right" id="rating-change">
                                                <?= $starsRating ?>
                                                <span class="text-black-5">( {{ $rateQuantity }} Rating )</span>
                                            </div>
                                        </div>
                                        <!-- hr -->
                                        <hr>
                                        <!-- plus-minus-pro-action -->
                                        <div class="plus-minus-pro-action clearfix">
                                            <div class="sin-plus-minus f-left clearfix">
                                                <p class="color-title f-left">{{ trans('message.quantity') }}</p>
                                                <div class="cart-plus-minus f-left">
                                                    <input type="text" value="01" min="1" name="qtybutton"
                                                        class="cart-plus-minus-box" id="valueQuantity">
                                                </div>
                                            </div>

                                        </div>
                                        <!-- plus-minus-pro-action end -->
                                        <!-- hr -->
                                        <hr>
                                        <!-- single-product-price -->
                                        <p class="color-title f-left">{{ trans('message.price') }}</p>
                                        <div class="s-price-box" style="border:none; padding:0">
                                            @if ($product->discount > 0)
                                                <span
                                                    class="new-price">{{ number_format($product->price - ($product->price * $product->discount) / 100) }}đ</span>
                                                <span class="old-price">{{ number_format($product->price) }}đ</span>
                                            @else <span
                                                    class="new-price">{{ number_format($product->price) }}đ</span>
                                            @endif
                                        </div>

                                        <!--  hr -->
                                        <hr>
                                        <div>
                                            <a href="javascript:" class="button extra-small button-black" tabindex="-1"
                                                onclick="BuyNow()">
                                                <span class="text-uppercase">{{ trans('message.buy_now') }}</span>
                                            </a>
                                            <a href="javascript:" class="button extra-small button-black"
                                                onclick="AddToCart(null)" tabindex="-1">
                                                <span class="text-uppercase">{{ trans('message.add_to_cart') }}</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!-- single-product-info end -->
                            </div>
                            <!-- single-product-tab -->
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- hr -->
                                    <hr>
                                    <div class="single-product-tab">
                                        <ul class="reviews-tab mb-20">
                                            <li class="active"><a href="#description"
                                                    data-toggle="tab">{{ trans('message.description') }}</a>
                                            </li>
                                            <li><a href="#information" data-toggle="tab">{{ trans('message.info') }}</a>
                                            </li>
                                            <li><a href="#reviews" data-toggle="tab">{{ trans('message.comment') }}</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane active" id="description">
                                                <div style="white-space: pre-line">
                                                    @if (Session::get('website_language') == 'en')
                                                        <?= $product->description_en ?>
                                                    @else
                                                        <?= $product->description_vi ?>
                                                    @endif
                                                </div>
                                            </div>
                                            <div role="tabpanel" class="tab-pane" id="information">
                                                <div class="row content">
                                                    @if (Session::get('website_language') == 'en')
                                                        <?= $product->content_en ?>
                                                    @else
                                                        <?= $product->content_vi ?>
                                                    @endif

                                                </div>

                                            </div>
                                            <div role="tabpanel" class="tab-pane" id="reviews">
                                                <!-- reviews-tab-desc -->
                                                <div class="reviews-tab-desc">
                                                    <!-- single comments -->
                                                    @foreach ($comments as $comment)
                                                        <div class="media mt-30">
                                                            <div class="media-body">
                                                                <div class="clearfix">
                                                                    <div class="name-commenter pull-left">
                                                                        <h6 class="media-heading"><a
                                                                                href="javascript:">{{ $comment->users->name ?? '' }}</a>
                                                                            <span
                                                                                class="ml-10"><?= Helper::instance()->show_stars($comment->rate) ?></span>
                                                                        </h6>
                                                                        <p class="mb-10">
                                                                            {{ date('d-m-Y H:i:s', strtotime($comment->created_at)) }}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <p class="mb-0">{{ $comment->content }}</p>
                                                            </div>
                                                        </div>
                                                    @endforeach

                                                </div>

                                                <div class="row mt-40">
                                                    @if (Auth()->user())
                                                        <div class="col-md-12" style="padding:0 !important">
                                                            <form id="comment-form" action="" method="post">
                                                                <div class="col-md-4">
                                                                    <input type="hidden" name="id"
                                                                        value="{{ $product->id }}">
                                                                    <input type="text" name="name"
                                                                        placeholder="{{ trans('message.name') }}..."
                                                                        value="{{ Auth()->user()->name }}" disabled>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <input type="text" name="email" placeholder="Email..."
                                                                        value="{{ Auth()->user()->email }}" disabled>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <input type="text" name="phone"
                                                                        placeholder="{{ trans('message.phone') }}..."
                                                                        value="{{ Auth()->user()->phone }}" disabled>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label
                                                                        style="width:100%">{{ trans('message.rating') }}</label>
                                                                    <ul class="list-inline rating-list">
                                                                        <li><i class="fa fa-star rating" title="Rate 5"
                                                                                data-rate='5'></i>
                                                                        </li>
                                                                        <li><i class="fa fa-star rating" title="Rate 4"
                                                                                data-rate='4'></i>
                                                                        </li>
                                                                        <li><i class="fa fa-star rating" title="Rate 3"
                                                                                data-rate='3'></i>
                                                                        </li>
                                                                        <li><i class="fa fa-star rating" title="Rate 2"
                                                                                data-rate='2'></i>
                                                                        </li>
                                                                        <li><i class="fa fa-star rating" title="Rate 1"
                                                                                data-rate='1'></i>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <span>{{ trans('message.content') }}:&nbsp;<label
                                                                            id="content-error" class="error"
                                                                            for="content" style="color:red"></label>
                                                                        <textarea class="custom-textarea" name="content"
                                                                            placeholder="{{ trans('message.content') }}..."></textarea>
                                                                        <button class="submit-btn-1 mt-30 btn-hover-1"
                                                                            type="button"
                                                                            id="send-comment">{{ trans('message.send_comment') }}</button>
                                                                </div>

                                                            </form>

                                                        </div>
                                                    @else
                                                        <div class="col-md-12">
                                                            <div class="col-md-12 text-center">
                                                                <a href="{{ route('loginClient') }}"
                                                                    class="button extra-small btn-submit-1">
                                                                    <span class="text-uppercase">Đăng nhập để bình
                                                                        luận</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--  hr -->
                                    <hr>
                                </div>
                            </div>
                        </div>
                        <!-- single-product-area end -->
                        <div class="related-product-area">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="section-title text-left mb-40">
                                        <h2 class="uppercase">{{ trans_choice('message.product_related', 1) }}</h2>
                                        <h6>{{ trans_choice('message.product_related', 2) }}</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="active-related-product">
                                    <!-- product-item start -->
                                    @foreach ($relatedProducts as $relatedProduct)
                                        <div class="col-xs-12">
                                            <div class="product-item">
                                                <div class="product-img">
                                                    <a href="{{ route('productDetail', $relatedProduct->id) }}">
                                                        <img src="{{ asset($relatedProduct->image) }}"
                                                            onerror="this.src='{{ asset('img/empty.png') }}'" alt="" />
                                                    </a>
                                                </div>
                                                <div class="product-info">
                                                    <h6 class="product-title">
                                                        <a href="{{ route('productDetail', $relatedProduct->id) }}">
                                                            @if (Session::get('website_language') == 'en')
                                                                {{ $relatedProduct->name_en }}
                                                            @else
                                                                {{ $relatedProduct->name_vi }}
                                                            @endif
                                                        </a>
                                                    </h6>
                                                    <div class="pro-rating">
                                                        <?= Helper::instance()->stars_averaged($relatedProduct->id) ?>
                                                    </div>
                                                    <div>
                                                        @foreach ($relatedProduct->details as $item)
                                                            <a href="#color1" data-toggle="tab"><span
                                                                    class="mt-1"
                                                                    style="border:solid lightgray 1px;height: 13px;width: 13px;background-color: {{ $item->colors->code }};border-radius: 50%;display: inline-block;"></span></a>
                                                        @endforeach
                                                    </div>
                                                    <h3 class="pro-price">
                                                        <div class="s-price-box" style="border:none; padding:0">
                                                            @if ($relatedProduct->discount > 0)
                                                                <span
                                                                    class="new-price">{{ number_format($relatedProduct->price - ($relatedProduct->price * $relatedProduct->discount) / 100) }}đ</span>
                                                                <span
                                                                    class="old-price">{{ number_format($relatedProduct->price) }}đ</span>
                                                            @else <span
                                                                    class="new-price">{{ number_format($relatedProduct->price) }}đ</span>
                                                            @endif
                                                        </div>
                                                    </h3>
                                                    <ul class="action-button">
                                                        <li>
                                                            <a href="#" data-toggle="modal"
                                                                data-target="#relatedModal{{ $relatedProduct->id }}"
                                                                title="{{ trans('message.quick_view') }}"><i
                                                                    class="zmdi zmdi-zoom-in"></i></a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('productDetail', $relatedProduct->id) }}"
                                                                title="{{ trans('message.buy_now') }}"><i
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
                    <div class="col-md-3 col-xs-12">
                        <!-- widget-search -->
                        <aside class="widget-search mb-30">
                            <form action="#">
                                <input type="text" placeholder="Search here...">
                                <button type="submit"><i class="zmdi zmdi-search"></i></button>
                            </form>
                        </aside>
                        <!-- widget-categories -->
                        <aside class="widget widget-categories box-shadow mb-30">
                            <h6 class="widget-title border-left mb-20">{{ trans('message.categories') }}</h6>
                            <div id="cat-treeview" class="product-cat">
                                <ul>
                                    @foreach ($categories as $category)
                                        <li><a href="{{ route('productsByCategory', $category->id) }}">
                                                @if (Session::get('website_language') == 'en')
                                                    {{ $category->name_en }}
                                                @else
                                                    {{ $category->name_vi }}
                                                @endif
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </aside>
                        <!-- widget-product -->
                        <aside class="widget widget-product box-shadow">
                            <h6 class="widget-title border-left mb-20">{{ trans('message.new_product') }}</h6>
                            <!-- product-item start -->
                            @foreach ($recentProducts as $recentProduct)
                                <div class="product-item">
                                    <div class="product-img">
                                        <a href="{{ route('productDetail', $recentProduct->id) }}">
                                            <img src="{{ asset($recentProduct->image) }}"
                                                onerror="this.src='{{ asset('img/empty.png') }}'" alt="" />
                                        </a>
                                    </div>
                                    <div class="product-info" style="padding-top:5px">
                                        <h6 class="product-title">
                                            <a href="{{ route('productDetail', $recentProduct->id) }}">
                                                @if (Session::get('website_language') == 'en')
                                                    {{ $recentProduct->name_en }}
                                                @else
                                                    {{ $recentProduct->name_vi }}
                                                @endif
                                            </a>
                                        </h6>
                                        <h3 class="pro-price">{{ number_format($recentProduct->price) }}đ</h3>
                                    </div>
                                </div>
                            @endforeach
                            <!-- product-item end -->
                        </aside>
                    </div>
                </div>
            </div>
        </div>
        <!-- SHOP SECTION END -->
        <!-- START QUICKVIEW PRODUCT -->
        <div id="quickview-wrapper">
            <!-- Modal -->
            @include('client.modal', ['name'=>'relatedModal','items'=>$relatedProducts ])
            <div class="modal fade" id="productModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="modal-product clearfix">
                                <div class="product-images">
                                    <div class="main-image images">
                                        <img alt="" src="{{ asset($product->image) }}"
                                            onerror="this.src='{{ asset('img/empty.png') }}'">
                                    </div>
                                </div><!-- .product-images -->

                                <div class="product-info">
                                    <h1>
                                        @if (Session::get('website_language') == 'en')
                                            {{ $product->name_en }}
                                        @else
                                            {{ $product->name_vi }}
                                        @endif
                                    </h1>
                                    <div class="price-box-3">
                                        <div class="s-price-box">
                                            @if ($product->discount > 0)
                                                <span
                                                    class="new-price">{{ number_format($product->price - ($product->price * $product->discount) / 100) }}đ</span>
                                                <span
                                                    class="old-price">{{ number_format($product->price) }}đ</span>
                                            @else <span
                                                    class="new-price">{{ number_format($product->price) }}đ</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="quick-add-to-cart">
                                        <form method="post" class="cart">
                                            <button class="single_add_to_cart_button"
                                                type="button">{{ trans('message.add_to_cart') }}</button>
                                        </form>
                                    </div>
                                    <div class="quick-desc">
                                        @if (Session::get('website_language') == 'en')
                                            {{ $product->description_en }}
                                        @else
                                            {{ $product->description_vi }}
                                        @endif

                                    </div>

                                </div><!-- .product-info -->
                            </div><!-- .modal-product -->
                        </div><!-- .modal-body -->
                    </div><!-- .modal-content -->
                </div><!-- .modal-dialog -->
            </div>
        </div>
    </section>
    <!-- End page content -->
@endsection
@section('jsScript')
    <script>
        $(document).ready(function() {
            var pick_rate = 0;

            $("#comment-form").validate({
                rules: {
                    "content": {
                        required: true,
                    },
                },
                messages: {
                    "content": {
                        required: "{{ trans('validation.payment.content.required') }}",
                    },

                }
            });

            $('#send-comment').on('click', function() {
                if ($("#comment-form").valid()) {
                    var data = {
                        'content': $("textarea[name='content']").val(),
                        'id': $("input[name='id']").val(),
                        'rate': pick_rate
                    }
                    $.ajax({
                        url: '/gui-binh-luan',
                        type: 'POST',
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'data': data
                        }
                    }).done(function(response) {
                        if (response) {
                            $('.reviews-tab-desc').empty();
                            $('.reviews-tab-desc').html(response);
                            $("textarea[name='content']").val("");
                            pick_rate = 0;
                            $('.rating').each(function(i, obj) {
                                $(this).removeAttr('style');
                            });
                            $.get('/hien-thi-danh-gia/' + data.id, function(result) {
                                $('#rating-change').empty();
                                $('#rating-change').html(result);
                            });
                            alertify.success(
                                '{{ trans('message.comment_success') }}'
                            );
                        } else {
                            alertify.error(
                                '{{ trans('message.comment_failed') }}'
                            );
                        }
                    })
                }
            })

            $('.rating').on('click', function() {
                pick_rate = $(this).data('rate');
                $('.rating').each(function(i, obj) {
                    if ($(this).data('rate') <= pick_rate) {
                        $(this).css('color', '#ffd700');
                    } else {
                        $(this).removeAttr('style');
                    }
                });
            });

        });
    </script>
@endsection
