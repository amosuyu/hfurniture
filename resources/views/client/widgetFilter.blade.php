<aside class="widget operating-system box-shadow mb-30">
    <h6 class="widget-title border-left mb-20">{{ trans('message.price') }}</h6>
    <form id="checkboxPrice" action="{{ request()->fullUrlWithQuery([]) }}">
        @if (isset($params['color']))
            <input type="hidden" name="color" value="{{ $params['color'] }}">
        @endif
        @if (isset($params['toSort']))
            <input type="hidden" name="toSort" value="{{ $params['toSort'] }}">
        @endif
        <label><input type="checkbox" name="price[]" value="offer1" @if (isset($params['price']) && in_array('offer1', $params['price'])) checked @endif>{{ trans('message.less_than') }} 1.000.000đ</label><br>
        <label><input type="checkbox" name="price[]" value="offer2" @if (isset($params['price']) && in_array('offer2', $params['price'])) checked @endif>500.000đ -
            1.000.000đ</label><br>
        <label><input type="checkbox" name="price[]" value="offer3" @if (isset($params['price']) && in_array('offer3', $params['price'])) checked @endif>1.000.000đ -
            1.500.000đ</label><br>
        <label><input type="checkbox" name="price[]" value="offer4" @if (isset($params['price']) && in_array('offer4', $params['price'])) checked @endif>2.000.000đ -
            5.000.000đ</label><br>
        <label><input type="checkbox" name="price[]" value="offer5" @if (isset($params['price']) && in_array('offer5', $params['price'])) checked @endif>{{ trans('message.more_than') }} 5.000.000đ</label><br>
    </form>
</aside>
<!-- widget-color -->
<aside class="widget box-shadow mb-30">
    <h6 class="widget-title border-left mb-20"> {{ trans('message.color') }}</h6>
    <ul>
        @foreach ($colors as $color)
            <li><span class="mt-1"
                    style="border:solid black 1px; height: 15px;width: 15px;background-color: {{ $color->code }};border-radius: 50%;display: inline-block;"></span>
                <a style="{{ $color->id == request()->query('color') ? 'color:#ff7f00' : '' }}"
                    href="{{ request()->fullUrlWithQuery(['color' => $color->id]) }}">{{ $color->name }}</a>
            </li>
        @endforeach

    </ul>
</aside>
