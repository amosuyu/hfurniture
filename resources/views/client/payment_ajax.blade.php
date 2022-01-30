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
            @if (Session::has('Voucher') != null)
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
            @if ($ship > 0)
                <td class="td-title-1">
                    {{ trans('message.ship') }}
                </td>
                <td class="td-title-2">
                    + {{ number_format($ship) }}đ
                </td>
            @endif
        </tr>
        <tr>
            <td class="order-total">{{ trans('message.total_order') }}</td>
            <td class="order-total-price">
                @if (Session::has('Cart') != null)
                    @if (Session::has('Voucher') != null)
                        @if (Session::get('Voucher')->amount > 0)
                            {{ number_format($ship + Session::get('Cart')->totalPrice - Session::get('Voucher')->amount) }}đ
                        @else
                            {{ number_format($ship + Session::get('Cart')->totalPrice - (Session::get('Cart')->totalPrice * Session::get('Voucher')->percent) / 100) }}đ
                        @endif
                    @else
                        {{ number_format(Session::get('Cart')->totalPrice + $ship) ?? 0 }}đ
                    @endif
                @endif
            </td>
        </tr>
