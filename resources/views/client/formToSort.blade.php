<div class="short-by f-left text-center">
    <form id="formToSort" action="{{ request()->fullUrlWithQuery([]) }}">
        @if (isset($params['price']))
            @foreach ($params['price'] as $value)
                <input type="hidden" name="price[]" value="{{ $value }}">
            @endforeach
        @endif
        @if (isset($params['color']))
                <input type="hidden" name="color" value="{{ $params['color'] }}">
        @endif
        <span>{{ trans('message.sort_by') }}:</span>
        <select id="selectToSort" name="toSort">
            <option value="latest" @if (isset($params['toSort']) && $params['toSort'] == 'latest') selected @endif>{{ trans('message.latest') }}</option>
            <option value="oldest" @if (isset($params['toSort']) && $params['toSort'] == 'oldest') selected @endif>{{ trans('message.oldest') }}</option>
            <option value="big-sale" @if (isset($params['toSort']) && $params['toSort'] == 'big-sale') selected @endif>{{ trans('message.big_sale') }}</option>
            <option value="hot" @if (isset($params['toSort']) && $params['toSort'] == 'hot') selected @endif>{{ trans('message.featured_products') }}</option>
            <option value="price-ascending" @if (isset($params['toSort']) && $params['toSort'] == 'price-ascending') selected @endif>{{ trans('message.price_increasing') }}</option>
            <option value="price-descending" @if (isset($params['toSort']) && $params['toSort'] == 'price-descending') selected @endif>{{ trans('message.price_decreasing') }}</option>
            <option value="title-ascending" @if (isset($params['toSort']) && $params['toSort'] == 'title-ascending') selected @endif>{{ trans('message.name') }}: A-Z</option>
            <option value="title-descending" @if (isset($params['toSort']) && $params['toSort'] == 'title-descending') selected @endif>{{ trans('message.name') }}: Z-A</option>
            <option value="best-selling" @if (isset($params['toSort']) && $params['toSort'] == 'best-selling') selected @endif>{{ trans('message.bestselling') }}</option>
        </select>
    </form>
</div>