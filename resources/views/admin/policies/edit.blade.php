@extends('admin.layout')
@section('pageTitle', 'Sửa chính sách')
@section('breadcrumb-first', 'Chính sách')
@section('breadcrumb-second', 'Sửa chính sách')
@section('main')
    <a class="text-primary waves-effect waves-light mb-2" href="{{ route('chinh-sach.index') }}"><i
            class="fa fa-angle-double-left"></i>&nbsp;Quay lại</a>
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <form action="{{ route('chinh-sach.update', $row->id) }}" method="POST">
                    {{ csrf_field() }}
                    {!! method_field('patch') !!}
                    <div class="form-group row">
                        <label for="example-text-input" class="col-2 col-form-label">Tên chính sách</label>

                        <div class="col-10">
                            <input class="form-control" type="text" value="{{ $row->name }}" id="example-text-input"
                                name="name" placeholder="Nhập tên chính sách...">
                            @error('name')
                                <div style="color:red" class="ml-1">
                                    <i class="typcn typcn-delete"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="example-text-input" class="col-2 col-form-label">Ẩn hiện</label>

                        <div class="col-10 d-flex">
                            <div class="custom-control custom-radio mr-2">
                                <input type="radio" id="show" name="display" value="1" class="custom-control-input"
                                    @if ($row->display == 1) checked @endif>
                                <label class="custom-control-label" for="show">Hiện</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="hide" name="display" value="0" class="custom-control-input"
                                    @if ($row->display == 0) checked @endif>
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
                        <label for="example-text-input" class="col-2 col-form-label">Nội dung</label>
                        <div class="col-10">
                            <textarea class="ckeditor form-control" type="text" id="example-text-input"
                                name="content">{{ $row->content }}</textarea>
                            @error('content')
                                <div style="color:red" class="ml-1">
                                    <i class="typcn typcn-delete"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
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
    <script type="text/javascript">
        CKEDITOR.replace('content', {
            filebrowserUploadUrl: "{{ route('ckeditor.image-upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form'
        });
    </script>
@endsection
