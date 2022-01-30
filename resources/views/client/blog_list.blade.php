@extends('client.layout')
@section('title', 'Danh sách tin tức')
@section('main')
    <!-- BREADCRUMBS SETCTION START -->
    <div class="breadcrumbs-section plr-200 mb-80">
        <div class="breadcrumbs overlay-bg">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="breadcrumbs-inner">
                            <h1 class="breadcrumbs-title">Danh sách tin tức</h1>
                            <ul class="breadcrumb-list">
                                <li><a href="{{ route('homeClient') }}">Trang chủ</a></li>
                                <li>Danh sách tin tức</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BREADCRUMBS SETCTION END -->

    <!-- Start page content -->
    <div id="page-content" class="page-wrapper">

        <!-- BLOG SECTION START -->
        <div class="blog-section mb-50">
            <div class="container">
                <div class="row">
                    <!-- blog-option start -->
                    <div class="col-md-12">
                        <div class="blog-option box-shadow mb-30  clearfix">
                            <!-- categories -->
                            <div class="dropdown f-left">
                                <button class="option-btn">
                                    Danh mục tin tức
                                    <i class="zmdi zmdi-chevron-down"></i>
                                </button>
                                <div class="dropdown-menu dropdown-width mt-30">
                                    <aside class="widget widget-categories box-shadow">
                                        <h6 class="widget-title border-left mb-20">Danh mục</h6>
                                        <div id="cat-treeview" class="product-cat">
                                            <ul>
                                                @foreach ($blogTypes as $blogType)
                                                    <li><a href="{{ route('blogList', $blogType->id) }}"
                                                            style="{{ $blogType->id == request()->route('id') ? 'color:#ff7f00' : '' }}">
                                                            {{ $blogType->title }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </aside>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- blog-option end -->
                </div>
                <div class="row">
                    <!-- blog-item start -->
                    @foreach ($blogs as $blog)
                        <div class="col-sm-6 col-xs-12">
                            <div class="blog-item-2">
                                <div class="row">
                                    <div class="col-md-6 col-xs-12">
                                        <div class="blog-image">
                                            <a href="{{ route('blogDetail', $blog->id) }}"><img
                                                    src="{{ asset($blog->image) }}"
                                                    onerror="this.src='{{ asset('img/empty.png') }}'" alt="" /></a>

                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xs-12">
                                        <div class="blog-desc">
                                            <h5 class="blog-title-2"><a
                                                    href="{{ route('blogDetail', $blog->id) }}">{{ $blog->title }}</a>
                                            </h5>
                                            <p>{!! Str::limit($blog->description, 100, ' ...') !!}</p>
                                            <div class=" read-more">
                                                <a href="{{ route('blogDetail', $blog->id) }}">Xem thêm</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <!-- blog-item end -->
                    <div class="text-center">
                        {{ $blogs->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
        <!-- BLOG SECTION END -->
    </div>
    <!-- End page content -->
@endsection
