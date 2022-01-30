@extends('admin.layout')
@section('cssLink')
    <link href="{{ asset('assets') }}/plugins/fileuploads/css/dropify.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('pageTitle','Thêm bộ sưu tập')
@section('breadcrumb-first','Bộ sưu tập')
@section('breadcrumb-second','Thêm bộ sưu tập')
@section('main')
<div class="row">
    <div class="col-12">
        <div class="card-box">
            <form action="{{route('bo-suu-tap.store')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-group row">
                    <label for="example-text-input" class="col-2 col-form-label">Tên bộ sưu tập</label>

                    <div class="col-10">
                        <input class="form-control" type="text" value="{{old('name_vi')}}" id="example-text-input" name="name_vi"
                            placeholder="Nhập tên bộ sưu tập...">
                        @error('name_vi')
                        <div style="color:red" class="ml-1">
                            <i class="typcn typcn-delete"></i> {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="example-text-input" class="col-2 col-form-label">Name collection</label>

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
                    <label for="example-text-input" class="col-2 col-form-label">Hình ảnh</label>
                    <div class="col-10">
                        <input type="file" class="dropify" name="image" />
                        @error('image')
                            <div style="color:red" class="ml-1">
                                <i class="typcn typcn-delete"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-2 col-form-label">Mô tả</label>

                    <div class="col-10">
                        <input class="form-control" type="text" value="{{old('description_vi')}}" id="example-text-input" name="description_vi"
                            placeholder="Nhập mô tả...">
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
                        <input class="form-control" type="text" value="{{old('description_en')}}" id="example-text-input" name="description_en"
                            placeholder="Enter description...">
                        @error('description_en')
                        <div style="color:red" class="ml-1">
                            <i class="typcn typcn-delete"></i> {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-2 col-form-label">Ẩn hiện bộ sưu tập</label>

                    <div class="col-10">
                    <select class="form-control" value="{{old('display')}}"  id="example-text-input"  name="display">
                        <option value="1">Hiện</option>
                        <option value="0">Ẩn</option>
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
@section('jsScript')
    <script>
        var resizefunc = [];
    </script>
    <script src="{{ asset('assets') }}/plugins/fileuploads/js/dropify.min.js"></script>
    <script type="text/javascript">
        $('.dropify').dropify({
            messages: {
                'default': 'Kéo thả hoặc nhấp chọn hình ảnh',
                'replace': 'Kéo thả hoặc nhấp chọn hình ảnh',
                'remove': 'Gỡ bỏ',
                'error': 'Rất tiếc, đã xảy ra lỗi!'
            },
            error: {
                'fileSize': 'Kích thước file không vượt quá 1M!'
            }
        });
    </script>
@endsection
