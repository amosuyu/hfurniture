@extends('client.layout')
@section('title', 'Tin tức')
@section('css')
<style>
    .content img {
        max-width: 100%;
    }
</style>
@endsection

@section('main')
    <!-- BREADCRUMBS SETCTION START -->
    <div class="breadcrumbs-section plr-200 mb-80">
        <div class="breadcrumbs overlay-bg">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="breadcrumbs-inner">
                            <h1 class="breadcrumbs-title">Tin tức</h1>
                            <ul class="breadcrumb-list">
                                <li><a href="{{ route('homeClient') }}">Trang chủ</a></li>
                                <li>Chi tiết tin tức</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BREADCRUMBS SETCTION END -->

    <!-- Start page content -->
    <section id="page-content" class="page-wrapper">

        <!-- BLOG SECTION START -->
        <div class="blog-section mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-md-9 col-xs-12">
                        <div class="blog-details-area">
                            <!-- blog-details-photo -->
                            <div class="blog-details-photo bg-img-1 p-20 mb-30">
                                <img src="{{ asset($blog->image) }}" onerror="this.src='{{ asset('img/empty.png') }}'"
                                    alt="" style="max-height:350px">
                                <div class="today-date bg-img-1">
                                    <span class="meta-date">{{ $blog->created_at->format('d') }}</span>
                                    <span class="meta-month">{{ $blog->created_at->format('M') }}</span>
                                </div>
                            </div>
                            <!-- blog-like-share -->
                            {{-- <ul class="blog-like-share mb-20">
                                <li>
                                    <a href="#"><i class="zmdi zmdi-favorite"></i>89 Like</a>
                                </li>
                                <li>
                                    <a href="#"><i class="zmdi zmdi-comments"></i>59 Comments</a>
                                </li>
                                <li>
                                    <a href="#"><i class="zmdi zmdi-share"></i>29 Share</a>
                                </li>
                            </ul> --}}
                            <!-- blog-details-title -->
                            <h3 class="blog-details-title mb-30">{{ $blog->title }}</h3>
                            <!-- blog-description -->
                            <div class="blog-description mb-60">
                                <p><?= $blog->content ?></p>
                            </div>
                            <!-- blog-share-tags -->
                            <div class="blog-share-tags box-shadow clearfix mb-60">
                                <?php
                                if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
                                    $url = 'https://';
                                } else {
                                    $url = 'http://';
                                }
                                
                                $url .= $_SERVER['HTTP_HOST'];
                                $url .= $_SERVER['REQUEST_URI'];
                                ?>
                                <div id="fb-root"></div>
                                <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v12.0"
                                                                nonce="rpFFq7Sl"></script>
                                <div class="fb-like" data-href="{{ $url }}" data-width=""
                                    data-layout="standard" data-action="like" data-size="small" data-share="true">
                                </div>
                                <!-- share -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-xs-12">
                        <!-- widget-search -->
                        <aside class="widget-search mb-30">
                            <form action="#">
                                <input type="text" placeholder="Search here...">
                                <button type="submit"><i class="zmdi zmdi-search"></i></button>
                            </form>
                        </aside>
                        <!-- widget-categories -->
                        <aside class="widget widget-categories box-shadow mb-30">
                            <h6 class="widget-title border-left mb-20">Danh mục</h6>
                            <div id="cat-treeview" class="product-cat">
                                <ul>
                                    @foreach ($blogTypes as $blogType)
                                        <li><a href="{{ route('blogList', $blogType->id) }}">{{ $blogType->title }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </aside>
                        <!-- widget-product -->
                        <aside class="widget widget-product box-shadow mb-30">
                            <h6 class="widget-title border-left mb-20">Tin tức khác</h6>
                            <!-- product-item start -->
                            @foreach ($otherBlogs as $otherBlog)
                                <div class="product-item">
                                    <div class="product-img">
                                        <a href="{{ route('blogDetail', $otherBlog->id) }}">
                                            <img width="100%" src="{{ asset($otherBlog->image) }}" onerror="this.src='{{ asset('img/empty.png') }}'" alt="" />
                                        </a>
                                    </div>
                                    <div class="product-info" style="padding-top: 0px">
                                        <h6 class="">
                                            <a href="{{ route('blogDetail', $otherBlog->id) }}">{!! Str::limit($otherBlog->title, 30, ' ...') !!}</a>
                                        </h6>
                                    </div>
                                </div>
                            @endforeach
                            <!-- product-item end -->
                        </aside>
                    </div>
                </div>
            </div>
        </div>
        <!-- BLOG SECTION END -->

    </section>
    <!-- End page content -->
@endsection
