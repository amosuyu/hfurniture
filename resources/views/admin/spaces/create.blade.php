@extends('admin.layout')
@section('pageTitle','Thêm không gian')
@section('breadcrumb-first','Không gian')
@section('breadcrumb-second','Thêm không gian')
@section('main')
<a class="text-primary waves-effect waves-light mb-2" href="{{ route('khong-gian.index') }}"><i class="fa fa-angle-double-left"></i>&nbsp;Quay lại</a>
<div class="row">
    <div class="col-12">
        <div class="card-box">
            <form action="{{route('khong-gian.store')}}" method="POST">
                {{csrf_field()}}
                <div class="form-group row">
                    <label for="example-text-input" class="col-2 col-form-label">Tên không gian</label>

                    <div class="col-10">
                        <input class="form-control" type="text" value="{{old('name_vi')}}" id="example-text-input" name="name_vi"
                            placeholder="Nhập tên không gian...">
                        @error('name_vi')
                        <div style="color:red" class="ml-1">
                            <i class="typcn typcn-delete"></i> {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-2 col-form-label">Name space</label>
                    <div class="col-10">
                        <input class="form-control" type="text" value="{{old('name_en')}}" id="example-text-input" name="name_en"
                            placeholder="Enter name...">
                        @error('name_en')
                        <div style="color:red" class="ml-1">
                            <i class="typcn typcn-delete"></i> {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-2 col-form-label">Mô tả</label>

                    <div class="col-10">
                        <textarea class="form-control" type="text"id="example-text-input" name="description_vi"
                            placeholder="Nhập mô tả...">{{old('description_vi')}}</textarea>
                        @error('description_vi')
                        <div style="color:red" class="ml-1">
                            <i class="typcn typcn-delete"></i> {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-2 col-form-label">Description</label>

                    <div class="col-10">
                        <textarea class="form-control" type="text" id="example-text-input" name="description_en"
                            placeholder="Enter description...">{{old('description_en')}}</textarea>
                        @error('description_en')
                        <div style="color:red" class="ml-1">
                            <i class="typcn typcn-delete"></i> {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-2 col-form-label">Ẩn hiện không gian</label>
                    <div class="col-10 d-flex">
                        <div class="custom-control custom-radio mr-2">
                            <input type="radio" id="show" name="display" value="1"
                                class="custom-control-input" checked>
                            <label class="custom-control-label" for="show">Hiện</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="hide" name="display" value="0"
                                class="custom-control-input">
                            <label class="custom-control-label" for="hide">Ẩn</label>
                        </div>
                        @error('display')
                        <div style="color:red" class="ml-1">
                            <i class="typcn typcn-delete"></i> {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-2 col-form-label">Slug</label>

                    <div class="col-10">
                        <input class="form-control" type="text" value="{{old('slug')}}" id="example-text-input" name="slug"
                            placeholder="Nhập slug...">
                        @error('slug')
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