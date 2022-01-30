@extends('client.layout')
@section('title', trans('message.contact') )
@section('main')
        <!-- BREADCRUMBS SETCTION START -->
        <div class="breadcrumbs-section plr-200 mb-80">
            <div class="breadcrumbs overlay-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="breadcrumbs-inner">
                                <h1 class="breadcrumbs-title">{{ trans('message.contact') }}</h1>
                                <ul class="breadcrumb-list">
                                    <li><a href="{{ route('homeClient') }}">{{ trans('message.home') }}</a></li>
                                    <li>{{ trans('message.contact') }}</li>
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

            <!-- ADDRESS SECTION START -->
            <div class="address-section mb-80">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4 col-xs-12">
                            <div class="contact-address box-shadow">
                                <i class="zmdi zmdi-pin"></i>
                                <h6>{{ trans('message.company_address') }}</h6>
                            </div>
                        </div>
                        <div class="col-sm-4 col-xs-12">
                            <div class="contact-address box-shadow">
                                <i class="zmdi zmdi-phone"></i>
                                <h6>(+880) 123 45678</h6>
                                <h6>(+880) 123 45678</h6>
                            </div>
                        </div>
                        <div class="col-sm-4 col-xs-12">
                            <div class="contact-address box-shadow">
                                <i class="zmdi zmdi-email"></i>
                                <h6>danhnhps11245@fpt.edu.vn</h6>
                                <h6>info@fhome.com</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ADDRESS SECTION END --> 
            
            <!-- MESSAGE BOX SECTION START -->
            <div class="message-box-section mt--50 mb-80">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            @if (session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session()->get('message') }}
                                </div>
                            @endif
                        </div>
                        <div class="col-md-12">
                            <div class="message-box box-shadow white-bg">
                                <form id="contact-form" action="{{ route('sendMailContact') }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h4 class="blog-section-title border-left mb-30">{{ trans('message.contact_us') }}</h4>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" name="name" placeholder="{{ trans('message.full_name') }}..." value="{{ old('name') }}" style="margin-bottom: 0px">
                                            <div style="color:red" class="mb-30">
                                                @error('name')
                                                    <i class="typcn typcn-delete"></i> {{ $message }}
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" name="email" placeholder="Email..." value="{{ old('email') }}" style="margin-bottom: 0px">
                                            <div style="color:red" class="mb-30">
                                                @error('email')
                                                    <i class="typcn typcn-delete"></i> {{ $message }}
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" name="phone" placeholder="{{ trans('message.phone') }}..." value="{{ old('phone') }}" style="margin-bottom: 0px">
                                            <div style="color:red" class="mb-30">
                                                @error('phone')
                                                    <i class="typcn typcn-delete"></i> {{ $message }}
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <textarea class="custom-textarea" name="message" placeholder="{{ trans('message.content') }}...">{{ old('message')}}</textarea>
                                            <div style="color:red" class="mb-30">
                                                @error('message')
                                                    <i class="typcn typcn-delete"></i> {{ $message }}
                                                @enderror
                                            </div>
                                            <button class="submit-btn-1 mt-30 btn-hover-1" type="submit">{{ trans('message.send_contact') }}</button>
                                        </div>
                                    </div>
                                </form>
                                <p class="form-messege"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- MESSAGE BOX SECTION END --> 
        </section>
        <!-- End page content -->
@endsection