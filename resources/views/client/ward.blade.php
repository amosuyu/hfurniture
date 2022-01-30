<option value="">{{ trans('message.ward') }}</option>
@foreach ($wards as $ward)
    <option value="{{ $ward['code'] }}">{{ $ward['name'] }}</option>
@endforeach
