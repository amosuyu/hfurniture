<option value="">{{ trans('message.district') }}</option>
@foreach ($districts as $district)
    <option value="{{ $district['code'] }}">{{ $district['name'] }}</option>
@endforeach
