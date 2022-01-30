@extends('admin.layout')
@section('pageTitle','Thêm loại sản phẩm')
@section('breadcrumb-first','Loại sản phẩm')
@section('breadcrumb-second','Thêm loại sản phẩm')
@section('main')
<a href="{{ route('loai-san-pham.index') }}"><i class="fa fa-angle-double-left"></i>&nbsp; Quay lại</a>
<div class="row">
    <div class="col-12">
        <div class="card-box">
            <form action="{{route('loai-san-pham.store')}}" method="POST">
                {{csrf_field()}}
                <div class="form-group row">
                    <label for="example-text-input" class="col-2 col-form-label">Tên loại sản phẩm</label>
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
                    <label for="example-text-input" class="col-2 col-form-label">Name category</label>
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
                    <label for="example-text-input" class="col-2 col-form-label">Không gian(Spaces)</label>
                    <div class="col-10">
                        <select class="form-control" value="{{old('space_id')}}"  id="example-text-input"  name="space_id">
                            <option value="">Chọn không gian phòng</option>
                            @foreach($Spaces as $Space)
                                <option value="{{$Space->id}}" @if (old('space_id') == $Space->id) selected @endif>{{$Space->name_vi}}  ({{$Space->name_en}})</option>
                            @endforeach  
                        </select>
                        @error('space_id')
                        <div style="color:red" class="ml-1">
                            <i class="typcn typcn-delete"></i> {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-2 col-form-label">Mô tả</label>

                    <div class="col-10">
                        <textarea class="form-control" type="text" id="example-text-input" name="description_vi"
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
                    <label for="example-text-input" class="col-2 col-form-label">Ẩn hiện loại sản phẩm</label>

                    <div class="col-10">
                    <select class="form-control" value="{{old('display')}}"  id="example-text-input"  name="display">
                        <option value="1" @if (old('display') == '1') selected @endif>Hiện</option>
                        <option value="0" @if (old('display') == '0') selected @endif>Ẩn</option>
                    </select>
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