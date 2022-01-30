@extends('admin.layout')
@section('pageTitle','Thêm màu sắc')
@section('breadcrumb-first','màu sắc')
@section('breadcrumb-second','Thêm màu sắc')
@section('main')
<div class="row">
    <div class="col-12">
        <div class="card-box">
            <form action="{{route('mau-sac.store')}}" method="POST">
                {{csrf_field()}}
                <div class="form-group row">
                    <label for="example-text-input" class="col-2 col-form-label">Tên màu sắc</label>

                    <div class="col-10">
                        <input class="form-control" type="text" value="{{old('name')}}" id="example-text-input" name="name"
                            placeholder="Nhập tên màu sắc...">
                        @error('name')
                        <div style="color:red" class="ml-1">
                            <i class="typcn typcn-delete"></i> {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-2 col-form-label">Mã màu</label>

                    <div class="col-10">
                        <input class="form-control" style="height: 50px;" type="color" value="{{old('code')}}" id="example-text-input" name="code"
                            placeholder="Nhập mã màu...">
                        @error('code')
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