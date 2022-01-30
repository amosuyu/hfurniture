@extends('admin.layout')
@section('pageTitle', 'Danh sách sản phẩm')
@section('breadcrumb-first', 'Sản phẩm')
@section('breadcrumb-second', 'Danh sách sản phẩm')
@section('main')
    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <strong class="d-block d-sm-inline-block-force">Thông báo</strong> {{ session()->get('success') }}
        </div>
    @endif
    @if (session()->has('errors'))
        <div class="alert alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <strong class="d-block d-sm-inline-block-force">Thông báo</strong> {{ session()->get('errors') }}
        </div>
    @endif
    <a class="btn btn-custom waves-effect waves-light mb-2" href="{{ route('san-pham.create') }}">Thêm sản phẩm</a>
    <div class="row">
        <div class="col-12">
            <div class="card-box table-responsive">
                <form action="{{ route('san-pham.index') }}" class="form-group row mb-2">
                    <div class="col-10">
                        Hiển thị
                        <?php $quantityDisplay = [10, 25, 50, 100]; ?>
                        <select name="filterQuantity" class="p-1">
                            @foreach ($quantityDisplay as $quantity)
                                <option value="{{ $quantity }}" @if (isset($params['filterQuantity']) && $params['filterQuantity'] == $quantity) selected @endif>
                                    {{ $quantity }}</option>
                            @endforeach
                        </select>
                        &nbsp;
                        Bộ sưu tập
                        <select name="filterCollection" class="p-1">
                            <option value="">Tìm theo bộ sưu tập</option>
                            @foreach ($collections as $collection)
                                <option value="{{ $collection->id }}" @if (isset($params['filterCollection']) && $params['filterQuantity'] == $collection->id) selected @endif>
                                    {{ $collection->name_vi }}</option>
                            @endforeach
                        </select>
                        &nbsp;
                        Loại sản phẩm
                        <select name="filterCategory" class="p-1">
                            <option value="">Tìm theo loại</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @if (isset($params['filterCategory']) && $params['filterCategory'] == $category->id) selected @endif>{{ $category->name_vi }}
                                </option>
                            @endforeach
                        </select>
                        &nbsp;
                        Từ khóa tìm kiếm
                        <input class="p-1" type="text" value="@if (isset($params['filterKeyword'])) {{ $params['filterKeyword'] }} @endif" name="filterKeyword">
                    </div>
                    <div class="col-2">
                        <button class="float-right p-1" type="submit">
                            <i class="fa fa-search"></i> Tìm kiếm</button>
                    </div>
                </form>
                <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên sản phẩm</th>
                            <th>Hình ảnh</th>
                            <th>Bộ sưu tập</th>
                            <th>Loại sản phẩm</th>
                            <th>Giá tiền</th>
                            <th>Giảm giá</th>
                            <th>Ẩn hiện</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name_vi }}<br> {{ $product->name_en }}</td>
                                <td><img src="{{ asset($product->image) }}" width="200" alt=""
                                        onerror="this.src='{{asset('img/empty.png')}}'"></td>
                                <td>{{ $product->collections ? $product->collections->name_vi : '' }}</td>
                                <td>{{ $product->categories ? $product->categories->name_vi : '' }}</td>
                                <td>{{ number_format($product->price) }}</td>
                                <td>{{ $product->discount ?? 0 }}%</td>
                                <td>{{ $product->display == 1 ? 'Hiện' : 'Ẩn' }}</td>

                                <td class="d-flex">
                                    <a href="{{ route('san-pham.edit', $product->id) }}" class="mr-3"><button
                                            type="button"
                                            class="btn btn-custom waves-effect waves-light  float-left mr-2 ">Sửa</button></a>
                                    <form action="{{ route('san-pham.destroy', $product->id) }}" method="post"
                                        class="mr-2  float-left">
                                        {{ csrf_field() }}
                                        {!! method_field('delete') !!}
                                        <button type="submit" class="btn btn-danger waves-effect waves-light"
                                            onclick="return confirm('Chấp nhận xóa?')">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $products->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
@endsection
