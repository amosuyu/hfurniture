@extends('admin.layout')
@section('pageTitle','Thêm loại tin')
@section('breadcrumb-first','Loại tin')
@section('breadcrumb-second','Thêm loại tin')
@section('main')
<a href="{{ route('loai-blog.index') }}"><i class="fa fa-angle-double-left"></i>&nbsp; Quay lại</a>
<div class="row">
    <div class="col-12">
        <div class="card-box">
            <form action="{{route('loai-blog.store')}}" method="POST">
                {{csrf_field()}}
                <div class="form-group row">
                    <label for="example-text-input" class="col-2 col-form-label">Tên loại blog</label>

                    <div class="col-10">
                        <input class="form-control" type="text" value="{{old('title')}}" id="example-text-input" name="title"
                            placeholder="Nhập tên loại blog...">
                        @error('title')
                        <div style="color:red" class="ml-1">
                            <i class="typcn typcn-delete"></i> {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-2 col-form-label">Mô tả </label>

                    <div class="col-10">
                        <textarea class="form-control" type="text" id="example-text-input" name="description"
                            placeholder="Nhập mô tả...">{{old('description')}}</textarea>
                        @error('description')
                        <div style="color:red" class="ml-1">
                            <i class="typcn typcn-delete"></i> {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-2 col-form-label">Ẩn hiện loại blog</label>

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