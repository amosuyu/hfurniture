@extends('admin.layout')
@section('pageTitle','Danh sách tin tức')
@section('breadcrumb-first','Tin tức')
@section('breadcrumb-second','Danh sách tin tức')
@section('main')
@if(session()->has('success'))
<div class="alert alert-success" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
    <strong class="d-block d-sm-inline-block-force">Thông báo</strong> {{session()->get('success')}}
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
<a class="btn btn-custom waves-effect waves-light mb-2" href="{{ route('blog.create') }}">Thêm tin tức</a>

<div class="row">
    <div class="col-12">
        <div class="card-box table-responsive">
            <form action="{{ route('blog.index') }}" class="form-group row mb-2">
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
                    &nbsp;
                    Loại tin
                    <select name="filterBlogType" class="p-1">
                        <option value="">Tìm theo loại</option>
                        @foreach ($blogTypes as $blogType)
                            <option value="{{ $blogType->id }}" @if (isset($params['filterBlogType']) && $params['filterBlogType'] == $blogType->id) selected @endif>{{ $blogType->title }}
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
                        <th>STT</th>
                        <th>Tiêu đề</th>
                        <th>Hình ảnh</th>
                        <th>Loại tin</th>
                        <th>Mô tả</th>
                        <th>Ẩn hiện</th>
                        <th>Hot</th>
                        <th>Slug</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($Blogs as $index =>$Blog)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$Blog->title}}</td>
                        <td>{{$Blog->blogType->title}}</td>
                        <td><img style="height:100px;width:100px" src="{{ asset($Blog->image) }}" alt="" onerror="this.src='{{asset('img/empty.png')}}'"></td>
                        <td>{{$Blog->description}}</td>
                        <!-- <td>{{$Blog->content}}</td> -->
                        <td>
                        @if ($Blog->display == 0)
                            Ẩn
                            @else
                            hiện  
                        @endif                   
                        </td>
                        <td>
                        @if ($Blog->hot == 0)
                        @endif
                        @if  ($Blog->hot == 1)
                           Hot
                        @endif
                        </td>
                        <td>{{$Blog->slug}}</td>
                        <td class="d">
                            <a href="{{route('blog.edit',$Blog->id)}}" class="mr-3"><button type="button"
                                    class="btn btn-custom waves-effect waves-light  float-left mr-2 ">Sửa</button></a>
                            <form action="{{route('blog.destroy',$Blog->id)}}" method="post" class="mr-2  float-left">
                                {{csrf_field()}}
                                {!! method_field('delete') !!}
                                <button type="submit" class="btn btn-danger waves-effect waves-light"
                                    onclick="return confirm('Chấp nhận xóa?')">Xóa</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $Blogs->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection