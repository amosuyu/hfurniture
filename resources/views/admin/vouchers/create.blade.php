@extends('admin.layout')
@section('pageTitle','Thêm thể loại')
@section('breadcrumb-first','Thể loại')
@section('breadcrumb-second','Thêm thể loại')
@section('main')
<div class="row">
    <div class="col-12">
        <div class="card-box">
            <form action="{{route('giam-gia.store')}}" method="POST">
                {{csrf_field()}}
                <div class="form-group row">
                    <label for="example-text-input" class="col-2 col-form-label">Code</label>

                    <div class="col-10">
                        <input class="form-control" type="text" value="{{old('code')}}" id="example-text-input" name="code"
                            placeholder="Nhập mã giảm giá...">
                        @error('code')
                        <div style="color:red" class="ml-1">
                            <i class="typcn typcn-delete"></i> {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-2 col-form-label">Mô tả</label>

                    <div class="col-10">
                        <input class="form-control" type="text" value="{{old('description')}}" id="example-text-input" name="description"
                            placeholder="Nhập mô tả giảm giá...">
                        @error('description')
                        <div style="color:red" class="ml-1">
                            <i class="typcn typcn-delete"></i> {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-2 col-form-label">Số tiền giảm</label>

                    <div class="col-10">
                        <input class="form-control" type="number" value="{{old('amount')}}" id="example-text-input" name="amount"
                            placeholder="Số tiền giảm..." min="0">
                        @error('amount')
                        <div style="color:red" class="ml-1">
                            <i class="typcn typcn-delete"></i> {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-2 col-form-label">Phần trăm giảm</label>

                    <div class="col-10">
                        <input class="form-control" type="number" value="{{old('percent')}}" id="example-text-input" name="percent"
                            placeholder="Phần trăm giảm..." min="0">
                        @error('percent')
                        <div style="color:red" class="ml-1">
                            <i class="typcn typcn-delete"></i> {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-2 col-form-label">Ngày kết thúc</label>

                    <div class="col-10">
                        <input class="form-control" type="date" value="{{old('end_date')}}" id="example-text-input" name="end_date"
                            >
                        @error('end_date')
                        <div style="color:red" class="ml-1">
                            <i class="typcn typcn-delete"></i> {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Thêm mới</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection