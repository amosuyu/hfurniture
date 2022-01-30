@extends('admin.layout')
@section('cssLink')
    <link href="{{ asset('assets') }}/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css" rel="stylesheet" />
    <link href="{{ asset('assets') }}/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets') }}/plugins/fileuploads/css/dropify.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('pageTitle', 'Thêm sản phẩm')
@section('breadcrumb-first', 'Sản phẩm')
@section('breadcrumb-second', 'Thêm sản phẩm')
@section('main')
    <a href="{{ route('san-pham.index') }}"><i class="fa fa-angle-double-left"></i>&nbsp;Quay lại</a>
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <form class="row" action="{{ route('san-pham.store') }}" method="POST"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 col-xl-8">
                        <fieldset class="form-group">
                            <label for="name_vi">Tên sản phẩm</label>
                            @error('name_vi')
                                <span style="color:red" class="ml-1">
                                    <i class="typcn typcn-delete"></i> {{ $message }}
                                </span>
                            @enderror
                            <input type="text" class="form-control" id="name_vi" name="name_vi"
                                placeholder="Tên sản phẩm..." value="{{ old('name_vi') }}">

                        </fieldset>
                        <fieldset class="form-group">
                            <label for="name_en">Product's name</label>
                            @error('name_en')
                                <span style="color:red" class="ml-1">
                                    <i class="typcn typcn-delete"></i> {{ $message }}
                                </span>
                            @enderror
                            <input type="text" class="form-control" id="name_en" name="name_en"
                                placeholder="Product's name..." value="{{ old('name_en') }}">

                        </fieldset>
                        <fieldset class="form-group">
                            <label for="collection_id">Bộ sưu tập</label>
                            @error('collection_id')
                                <span style="color:red" class="ml-1">
                                    <i class="typcn typcn-delete"></i> {{ $message }}
                                </span>
                            @enderror
                            <select class="form-control select2" id="collection_id" name="collection_id">
                                <option value="">Bộ sưu tập</option>
                                @foreach ($collections as $collection)
                                    <option value="{{ $collection->id }}" @if (old('collection_id') == $collection->id) selected @endif>
                                        {{ $collection->name_vi }}</option>
                                @endforeach
                            </select>
                        </fieldset>
                        <fieldset class="form-group">
                            <label for="category_id">Loại sản phẩm</label>
                            @error('category_id')
                                <span style="color:red" class="ml-1">
                                    <i class="typcn typcn-delete"></i> {{ $message }}
                                </span>
                            @enderror
                            <select class="form-control select2" id="category_id" name="category_id">
                                <option value="">Loại sản phẩm</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @if (old('category_id') == $category->id) selected @endif>
                                        {{ $category->name_vi }}
                                    </option>
                                @endforeach
                            </select>
                        </fieldset>
                        <fieldset class="form-group">
                            <label for="slug">Slug</label>
                            @error('slug')
                                <span style="color:red" class="ml-1">
                                    <i class="typcn typcn-delete"></i> {{ $message }}
                                </span>
                            @enderror
                            <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug') }}">
                        </fieldset>
                        <fieldset class="form-group">
                            <label for="description_vi">Mô tả</label>
                            @error('description_vi')
                                <span style="color:red" class="ml-1">
                                    <i class="typcn typcn-delete"></i> {{ $message }}
                                </span>
                            @enderror
                            <textarea class="form-control" id="description_vi" rows="3" placeholder="Mô tả..."
                                name="description_vi">{{ old('description_vi') }}</textarea>
                        </fieldset>
                        <fieldset class="form-group">
                            <label for="description_en">Description</label>
                            @error('description_en')
                                <span style="color:red" class="ml-1">
                                    <i class="typcn typcn-delete"></i> {{ $message }}
                                </span>
                            @enderror
                            <textarea class="form-control" id="description_en" rows="3" name="description_en"
                                placeholder="Description...">{{ old('description_en') }}</textarea>
                        </fieldset>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 col-xl-4 m-t-sm-40">
                        <fieldset>
                            <label>Hình</label>
                            @error('image')
                                <span style="color:red" class="ml-1">
                                    <i class="typcn typcn-delete"></i> {{ $message }}
                                </span>
                            @enderror
                            <input type="file" class="dropify" name="image" />
                        </fieldset>
                        <fieldset class="form-group">
                            <label for="color_id">Hình theo màu</label>
                            @error('color_id')
                                <span style="color:red" class="ml-1">
                                    <i class="typcn typcn-delete"></i> {{ $message }}
                                </span>
                            @enderror
                            <ul class="nav nav-tabs m-b-10" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="color{{ $colors[0]->id }}-tab" data-toggle="tab"
                                        href="#color{{ $colors[0]->id }}" role="tab"
                                        aria-controls="color{{ $colors[0]->id }}" aria-expanded="true"><span
                                            class="px-3"
                                            style="background-color:{{ $colors[0]->code }}"></span></a>
                                </li>
                                @foreach ($colors as $index => $color)
                                    @if ($index > 0)
                                        <li class="nav-item">
                                            <a class="nav-link" id="color{{ $color->id }}-tab" data-toggle="tab"
                                                href="#color{{ $color->id }}" role="tab"
                                                aria-controls="color{{ $color->id }}"><span class="px-3 border"
                                                    style="background-color:{{ $color->code }}"></span></a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <?php
                                $quantity = 'quantity_' . $colors[0]->id;
                                $file = 'file_' . $colors[0]->id . '[]';
                                ?>
                                <div role="tabpanel" class="tab-pane fade in active show" id="color{{ $colors[0]->id }}"
                                    aria-labelledby="color{{ $colors[0]->id }}-tab">
                                    <fieldset class="form-group">
                                        <label for="{{ $quantity }}">Số lượng</label>
                                        @error($quantity)
                                            <span style="color:red" class="ml-1">
                                                <i class="typcn typcn-delete"></i> {{ $message }}
                                            </span>
                                        @enderror
                                        <input type="number" class="form-control" id="{{ $quantity }}"
                                            name="{{ $quantity }}" placeholder="Số lượng" min="0"
                                            value="{{ old($quantity) }}">
                                    </fieldset>
                                    <input type="file" name="{{ $file }}" multiple
                                        onchange="<?php ?>" />
                                </div>
                                @foreach ($colors as $index => $color)
                                    @if ($index > 0)
                                        <?php
                                        $quantity = 'quantity_' . $color->id;
                                        $file = 'file_' . $color->id . '[]';
                                        ?>
                                        <div class="tab-pane fade" id="color{{ $color->id }}" role="tabpanel"
                                            aria-labelledby="color{{ $color->id }}-tab">
                                            <fieldset class="form-group">
                                                <label for="{{ $quantity }}">Số lượng</label>
                                                @error($quantity)
                                                    <span style="color:red" class="ml-1">
                                                        <i class="typcn typcn-delete"></i> {{ $message }}
                                                    </span>
                                                @enderror
                                                <input type="number" class="form-control" id="{{ $quantity }}"
                                                    name="{{ $quantity }}" placeholder="Số lượng" min="0"
                                                    value="{{ old($quantity) }}">

                                            </fieldset>
                                            <input type="file" name="{{ $file }}" multiple />
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </fieldset>
                        <fieldset class="form-group mt-4">
                            <div class="row">
                                <div class="col-6">
                                    <label for="price">Giá tiền</label>
                                    <input type="number" class="form-control" id="price" name="price" min="0"
                                        value="{{ old('price') }}">
                                    @error('price')
                                        <span style="color:red" class="ml-1">
                                            <i class="typcn typcn-delete"></i> {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="length">Giảm giá %</label>
                                    @error('discount')
                                        <span style="color:red" class="ml-1">
                                            <i class="typcn typcn-delete"></i> {{ $message }}
                                        </span>
                                    @enderror
                                    <input type="number" class="form-control" id="discount" name="discount" min="0"
                                        value="{{ old('discount') }}">
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="form-group mt-4">
                            <div class="row">
                                <div class="col-4">
                                    <label for="length">Chiều dài (cm)</label>
                                    @error('length')
                                        <span style="color:red" class="ml-1">
                                            <i class="typcn typcn-delete"></i> {{ $message }}
                                        </span>
                                    @enderror
                                    <input type="number" class="form-control" id="length" name="length" min="0"
                                        value="{{ old('length') }}">
                                </div>
                                <div class="col-4">
                                    <label for="length">Chiều cao (cm)</label>
                                    <input type="number" class="form-control" id="height" name="height" min="0"
                                        value="{{ old('height') }}">
                                    @error('height')
                                        <span style="color:red" class="ml-1">
                                            <i class="typcn typcn-delete"></i> {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-4">
                                    <label for="length">Chiều rộng (cm)</label>
                                    <input type="number" class="form-control" id="width" name="width" min="0"
                                        value="{{ old('width') }}">
                                    @error('width')
                                        <span style="color:red" class="ml-1">
                                            <i class="typcn typcn-delete"></i> {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="form-group row mt-3">
                                <div class="col-6 d-flex ">
                                    <div class="custom-control custom-radio mr-2">
                                        <input type="radio" id="show" name="display" value="1" class="custom-control-input"
                                            checked>
                                        <label class="custom-control-label" for="show">Hiện</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="hide" name="display" value="0" class="custom-control-input">
                                        <label class="custom-control-label" for="hide">Ẩn</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="hot" value="1" id="hot"
                                            @if (old('hot') == 1) checked @endif>
                                        <label class="custom-control-label" for="hot">Nổi bật</label>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 col-xl-12">

                        <label for="content">Nội dung</label>
                        <ul class="nav nav-tabs m-b-10" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                    aria-controls="home" aria-expanded="true">Nội dung</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                    aria-controls="profile">Content</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div role="tabpanel" class="tab-pane fade in active show" id="home" aria-labelledby="home-tab">
                                <textarea class="ckeditor form-control" id="content_vi" name="content_vi">
                                        {{ old('content_vi') }}
                                    </textarea>
                                @error('content_vi')
                                    <span style="color:red" class="ml-1">
                                        <i class="typcn typcn-delete"></i> {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <textarea class="ckeditor form-control" id="content_en" name="content_en">
                                             {{ old('content_en') }}
                                    </textarea>
                                @error('content_en')
                                    <span style="color:red" class="ml-1">
                                        <i class="typcn typcn-delete"></i> {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Thêm mới</button>
                        </div>
                    </div>
                </form><!-- end row -->
            </div>
        </div><!-- end col -->
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
        CKEDITOR.replace('content_vi', {
            filebrowserUploadUrl: "{{ route('ckeditor.image-upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form'
        });

        CKEDITOR.replace('content_en', {
            filebrowserUploadUrl: "{{ route('ckeditor.image-upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form'
        });
    </script>
@endsection
