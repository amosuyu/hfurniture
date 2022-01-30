
@foreach ($items as $item)
    <div class="modal fade" id="{{ $name }}{{ $item->id }}" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document"
            style="margin: 5% auto;max-width: 96%;min-height: 300px;padding: 20px;width: 870px">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="modal-product clearfix">
                        <div class="product-images">
                            <div class="main-image images">
                                <img alt="" src="{{ asset($item->image) }}"
                                    onerror="this.src='{{ asset('img/empty.png') }}'">
                            </div>
                        </div><!-- .product-images -->

                        <div class="product-info">
                            <h1>
                                @if (Session::get('website_language') == 'en')
                                    {{ $item->name_en ?? $item->name_vi }}
                                @else
                                    {{ $item->name_vi }}
                                @endif
                            </h1>
                            <div class="price-box-3">
                                <div class="s-price-box">
                                    @if ($item->discount > 0)
                                        <span
                                            class="new-price">{{ number_format($item->price - ($item->price * $item->discount) / 100) }}đ</span>
                                        <span class="old-price">{{ number_format($item->price) }}đ</span>
                                    @else <span class="new-price">{{ number_format($item->price) }}đ</span>
                                    @endif
                                </div>
                            </div>
                            <a href="{{ route('productDetail', $item->id) }}"
                                class="see-all">{{ trans('message.view_detail') }}</a>
                            <div class="quick-add-to-cart">
                                <div>
                                    <ul class="reviews-tab mb-20">
                                        @foreach ($item->details as $key => $detail)
                                            <li class=" @if ($key == 0)active @endif" style="margin-right:10px"
                                                onclick="changeColor({{ $detail->id }}, {{ $item->id }})">
                                                <a href="#color{{ $detail->color_id }}" data-toggle="tab"><span
                                                        class="mt-1"
                                                        style="border:solid lightgray 1px;height: 13px;width: 13px;background-color: {{ $detail->colors->code }};border-radius: 50%;display: inline-block;"></span></a>
                                            </li>
                                        @endforeach
                                        <input type="hidden" class="valueByColor{{ $item->id }}"
                                            value="{{ $item->details[0]->id ?? ''}}">
                                    </ul>
                                </div>
                                <div class="numbers-row">
                                    <input type="number" id="french-hens" class="valueQuantity{{ $item->id }}"
                                        value="1" min="1" onchange="changeQuantity(this.value, {{ $item->id }} )">
                                </div>
                                <button class="single_add_to_cart_button" type="button"
                                    onclick="AddToCart({{ $item->id }})">{{ trans('message.add_to_cart') }}</button>
                            </div>
                            <div class="quick-desc">
                                @if (Session::get('website_language') == 'en')
                                    {{ $item->description_en ?? $item->description_vi }}
                                @else
                                    {{ $item->description_vi }}
                                @endif
                            </div>
                            {{-- <div class="social-sharing">
                    <div class="widget widget_socialsharing_widget">
                        <h3 class="widget-title-modal">Share this product</h3>
                        <ul class="social-icons clearfix">
                            <li>
                                <a class="facebook" href="#" target="_blank" title="Facebook">
                                    <i class="zmdi zmdi-facebook"></i>
                                </a>
                            </li>
                            <li>
                                <a class="google-plus" href="#" target="_blank" title="Google +">
                                    <i class="zmdi zmdi-google-plus"></i>
                                </a>
                            </li>
                            <li>
                                <a class="twitter" href="#" target="_blank" title="Twitter">
                                    <i class="zmdi zmdi-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a class="pinterest" href="#" target="_blank" title="Pinterest">
                                    <i class="zmdi zmdi-pinterest"></i>
                                </a>
                            </li>
                            <li>
                                <a class="rss" href="#" target="_blank" title="RSS">
                                    <i class="zmdi zmdi-rss"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div> --}}
                        </div><!-- .product-info -->
                    </div><!-- .modal-product -->
                </div><!-- .modal-body -->
            </div><!-- .modal-content -->
        </div><!-- .modal-dialog -->
    </div>
@endforeach
