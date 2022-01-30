@extends('client.layout')
@section('main')
        <!-- BREADCRUMBS SETCTION START -->
        <div class="breadcrumbs-section plr-200 mb-80">
            <div class="breadcrumbs overlay-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="breadcrumbs-inner">
                                <h1 class="breadcrumbs-title">Chi tiết chính sách</h1>
                                <ul class="breadcrumb-list">
                                    <li><a href="{{ route('homeClient') }}">Trang chủ</a></li>
                                    <li>Chi tiết chính sách</li>
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
                        <div class="col-md-12 col-xs-12">
                            <div class="blog-details-area">
                                <!-- blog-details-title -->
                                <h3 class="blog-details-title mb-30">{{ $policy->name }}</h3>
                                <!-- blog-description -->
                                <div class="blog-description mb-60">
                                  <?= $policy->content ?>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- BLOG SECTION END -->             

        </section>
        <!-- End page content -->
@endsection