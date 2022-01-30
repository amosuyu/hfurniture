@extends('admin.layout')
@section('cssLink')
    <link href="{{ asset('assets') }}/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css" rel="stylesheet" />
    <link href="{{ asset('assets') }}/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets') }}/plugins/fileuploads/css/dropify.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('pageTitle', 'Thêm tin tức')
@section('breadcrumb-first', 'Tin tức')
@section('breadcrumb-second', 'Thêm tin tức')
@section('main')
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <form action="{{ route('blog.update', $row->id) }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {!!method_field('patch')!!}
                    <div class="form-group row">
                        <label for="example-text-input" class="col-2 col-form-label">Loại tin</label>
                        <div class="col-10">
                            <select class="form-control select2" id="example-text-input"
                                name="blog_type_id">
                                <option value="">Chọn loại tin</option>
                                @foreach ($blogTypes as $blogType)
                                    <option value="{{ $blogType->id }}" @if($row->blog_type_id == $blogType->id) selected @endif>{{ $blogType->title }}</option>
                                @endforeach
                            </select>
                            @error('blog_type_id')
                            <div style="color:red" class="ml-1">
                                <i class="typcn typcn-delete"></i> {{ $message }}
                            </div>
                        @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-2 col-form-label">Title</label>

                        <div class="col-10">
                            <input class="form-control" type="text" value="{{ $row->title }}" id="example-text-input"
                                name="title" placeholder="Nhập tiêu đề...">
                            @error('title')
                                <div style="color:red" class="ml-1">
                                    <i class="typcn typcn-delete"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-2 col-form-label">Hình ảnh</label>
                        <div class="col-10">
                            <input type="file" class="dropify" name="image" data-default-file="{{ $row->image }}"/>
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
                            <textarea class="form-control" type="text" value="{{ old('description') }}"
                                id="example-text-input" name="description" placeholder="Nhập mô tả...">{{ $row->description }}</textarea>
                            @error('description')
                                <div style="color:red" class="ml-1">
                                    <i class="typcn typcn-delete"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-2 col-form-label">Nội dung</label>

                        <div class="col-10">
                            <textarea class="ckeditor form-control" type="text"
                                id="example-text-input" name="content">{{ $row->content }}</textarea>
                            @error('content')
                                <div style="color:red" class="ml-1">
                                    <i class="typcn typcn-delete"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-2 col-form-label">Ẩn hiện</label>

                        <div class="col-10">
                            <select class="form-control" value="{{ old('display') }}" id="example-text-input"
                                name="display">
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
                        <label for="example-text-input" class="col-2 col-form-label">Hot</label>

                        <div class="col-10">
                            <select class="form-control" value="{{ old('hot') }}" id="example-text-input" name="hot">
                                <option value="0" @if (old('hot') == '0') selected @endif>Bình thường</option>
                                <option value="1" @if (old('hot') == '1') selected @endif>Hot</option>
                            </select>
                            @error('hot')
                                <div style="color:red" class="ml-1">
                                    <i class="typcn typcn-delete"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-2 col-form-label">Slug</label>

                        <div class="col-10">
                            <input class="form-control" type="text" value="{{ $row->slug }}" id="example-text-input"
                                name="slug" placeholder="Nhập slug...">
                            @error('slug')
                                <div style="color:red" class="ml-1">
                                    <i class="typcn typcn-delete"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
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
    <script src="{{ asset('ckeditor') }}/ckeditor.js"></script>
    <script src="{{ asset('assets') }}/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.js"></script>
    <script type="text/javascript" src="{{ asset('assets') }}/plugins/multiselect/js/jquery.multi-select.js"></script>
    <script src="{{ asset('assets') }}/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="{{ asset('assets') }}/pages/jquery.formadvanced.init.js"></script>
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
        CKEDITOR.replace('content', {
            filebrowserUploadUrl: "{{ route('ckeditor.image-upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form'
        });
    </script>
@endsection
