<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <!-- App Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets') }}/images/favicon.ico">

    <!-- App title -->
    <title>Quản trị H-Furniture</title>


    @yield('cssLink')
    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/morris/morris.css">

    <!-- Switchery css -->
    <link href="{{ asset('assets') }}/plugins/switchery/switchery.min.css" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets') }}/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

    <!-- App CSS -->
    <link href="{{ asset('assets') }}/css/style.css" rel="stylesheet" type="text/css" />

    <!-- Modernizr js -->
    <script src="{{ asset('assets') }}/js/modernizr.min.js"></script>

</head>


<body class="fixed-left">

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Top Bar Start -->
        <div class="topbar">

            <!-- LOGO -->
            <div class="topbar-left">
                <a href="/admin" class="logo">
                    <i class="zmdi zmdi-group-work icon-c-logo"></i>
                    <span>{{ __('H-Furniture') }}</span></a>
            </div>

            <nav class="navbar-custom">

                <ul class="list-inline float-right mb-0">
                    <li class="list-inline-item dropdown notification-list">
                        <a class="nav-link dropdown-toggle arrow-none waves-light waves-effect" data-toggle="dropdown"
                            href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="zmdi zmdi-notifications-none noti-icon"></i>
                            <span class="noti-icon-badge"></span>
                        </a>
                        {{-- <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-lg"
                            aria-labelledby="Preview">
                            <!-- item-->
                            <div class="dropdown-item noti-title">
                                <h5><small><span class="label label-danger pull-xs-right">7</span>Notification</small>
                                </h5>
                            </div>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="notify-icon bg-success"><i class="icon-bubble"></i></div>
                                <p class="notify-details">Robert S. Taylor commented on Admin<small
                                        class="text-muted">1min ago</small></p>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="notify-icon bg-info"><i class="icon-user"></i></div>
                                <p class="notify-details">New user registered.<small class="text-muted">1min ago</small>
                                </p>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="notify-icon bg-danger"><i class="icon-like"></i></div>
                                <p class="notify-details">Carlos Crouch liked <b>Admin</b><small class="text-muted">1min
                                        ago</small></p>
                            </a>

                            <!-- All-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item notify-all">
                                View All
                            </a>

                        </div> --}}
                    </li>

                    <li class="list-inline-item dropdown notification-list">
                        <a class="nav-link dropdown-toggle arrow-none waves-light waves-effect" data-toggle="dropdown"
                            href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="zmdi zmdi-email noti-icon"></i>
                            <span class="noti-icon-badge"></span>
                        </a>
                        {{-- <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-arrow-success dropdown-lg"
                            aria-labelledby="Preview">
                            <!-- item-->
                            <div class="dropdown-item noti-title bg-success">
                                <h5><small><span class="label label-danger pull-xs-right">7</span>Messages</small></h5>
                            </div>

                        
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="notify-icon bg-faded">
                                    <img src="{{asset('assets')}}/images/users/avatar-2.jpg" alt="img"
                                        class="rounded-circle img-fluid">
                                </div>
                                <p class="notify-details">
                                    <b>Robert Taylor</b>
                                    <span>New tasks needs to be done</span>
                                    <small class="text-muted">1min ago</small>
                                </p>
                            </a>

                         
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="notify-icon bg-faded">
                                    <img src="{{asset('assets')}}/images/users/avatar-3.jpg" alt="img"
                                        class="rounded-circle img-fluid">
                                </div>
                                <p class="notify-details">
                                    <b>Carlos Crouch</b>
                                    <span>New tasks needs to be done</span>
                                    <small class="text-muted">1min ago</small>
                                </p>
                            </a>

                      
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="notify-icon bg-faded">
                                    <img src="{{asset('assets')}}/images/users/avatar-4.jpg" alt="img"
                                        class="rounded-circle img-fluid">
                                </div>
                                <p class="notify-details">
                                    <b>Robert Taylor</b>
                                    <span>New tasks needs to be done</span>
                                    <small class="text-muted">1min ago</small>
                                </p>
                            </a>

                            <a href="javascript:void(0);" class="dropdown-item notify-item notify-all">
                                View All
                            </a>

                        </div> --}}
                    </li>

                    <li class="list-inline-item dropdown notification-list">
                        <a class="nav-link waves-effect waves-light right-bar-toggle" href="javascript:void(0);">
                            <i class="zmdi zmdi-format-subject noti-icon"></i>
                        </a>
                    </li>

                    <li class="list-inline-item dropdown notification-list">
                        <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown"
                            href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <img src="{{ asset('assets') }}/images/users/avatar-1.jpg" alt="user"
                                class="rounded-circle">
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-dropdown " aria-labelledby="Preview">
                            <!-- item-->
                            <div class="dropdown-item noti-title">
                                <h5 class="text-overflow"><small>{{ auth::user()->name }}</small> </h5>
                            </div>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="zmdi zmdi-account-circle"></i> <span>Thông tin</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="zmdi zmdi-settings"></i> <span>Cài đặt</span>
                            </a>

                            <!-- item-->


                            <!-- item-->
                            <a href="{{route('logout')}}" class="dropdown-item notify-item">
                                <i class="zmdi zmdi-power"></i> <span>Đăng xuất</span>
                            </a>

                        </div>
                    </li>

                </ul>

                <ul class="list-inline menu-left mb-0">
                    <li class="float-left">
                        <button class="button-menu-mobile open-left waves-light waves-effect">
                            <i class="zmdi zmdi-menu"></i>
                        </button>
                    </li>
                    <li class="hidden-mobile app-search">
                        <form role="search" class="">
                            <input type="text" placeholder="Tìm kiếm" class="form-control">
                            <a href=""><i class="fa fa-search"></i></a>
                        </form>
                    </li>
                </ul>

            </nav>

        </div>
        <!-- Top Bar End -->


        <!-- ========== Left Sidebar Start ========== -->
        <?= View::make('admin.menu') ?>
        <!-- Left Sidebar End -->



        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-xl-12">
                            <div class="page-title-box">

                                <h4 class="page-title float-left">@yield('pageTitle')</h4>

                                <ol class="breadcrumb float-right">
                                    <li class="breadcrumb-item"><a href="{{route('home')}}">Trang chủ</a></li>
                                    <li class="breadcrumb-item"><a href="">@yield('breadcrumb-first')</a></li>
                                    <li class="breadcrumb-item active">@yield('breadcrumb-second')</li>
                                </ol>

                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                    @yield('main')
                    <!-- end row -->


                </div> <!-- container -->

            </div> <!-- content -->



        </div>
        <!-- End content-page -->


        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->


        <!-- Right Sidebar -->
        {{-- <div class="side-bar right-bar">
            <div class="nicescroll">
                <ul class="nav nav-pills nav-justified text-xs-center">
                    <li class="nav-item">
                        <a href="#home-2" class="nav-link active" data-toggle="tab" aria-expanded="false">
                            Activity
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#messages-2" class="nav-link" data-toggle="tab" aria-expanded="true">
                            Settings
                        </a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade active show" id="home-2">
                        <div class="timeline-2">
                            <div class="time-item">
                                <div class="item-info">
                                    <small class="text-muted">5 minutes ago</small>
                                    <p><strong><a href="#" class="text-info">John Doe</a></strong> Uploaded a photo
                                        <strong>"DSC000586.jpg"</strong></p>
                                </div>
                            </div>

                            <div class="time-item">
                                <div class="item-info">
                                    <small class="text-muted">30 minutes ago</small>
                                    <p><a href="" class="text-info">Lorem</a> commented your post.</p>
                                    <p><em>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam laoreet
                                            tellus ut tincidunt euismod. "</em></p>
                                </div>
                            </div>

                            <div class="time-item">
                                <div class="item-info">
                                    <small class="text-muted">59 minutes ago</small>
                                    <p><a href="" class="text-info">Jessi</a> attended a meeting with<a href="#"
                                            class="text-success">John Doe</a>.</p>
                                    <p><em>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam laoreet
                                            tellus ut tincidunt euismod. "</em></p>
                                </div>
                            </div>

                            <div class="time-item">
                                <div class="item-info">
                                    <small class="text-muted">1 hour ago</small>
                                    <p><strong><a href="#" class="text-info">John Doe</a></strong>Uploaded 2 new photos
                                    </p>
                                </div>
                            </div>

                            <div class="time-item">
                                <div class="item-info">
                                    <small class="text-muted">3 hours ago</small>
                                    <p><a href="" class="text-info">Lorem</a> commented your post.</p>
                                    <p><em>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam laoreet
                                            tellus ut tincidunt euismod. "</em></p>
                                </div>
                            </div>

                            <div class="time-item">
                                <div class="item-info">
                                    <small class="text-muted">5 hours ago</small>
                                    <p><a href="" class="text-info">Jessi</a> attended a meeting with<a href="#"
                                            class="text-success">John Doe</a>.</p>
                                    <p><em>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam laoreet
                                            tellus ut tincidunt euismod. "</em></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="messages-2">

                        <div class="row m-t-10">
                            <div class="col-8">
                                <h5 class="m-0">Notifications</h5>
                                <p class="text-muted m-b-0"><small>Do you need them?</small></p>
                            </div>
                            <div class="col-4 text-right">
                                <input type="checkbox" checked data-plugin="switchery" data-color="#1bb99a"
                                    data-size="small" />
                            </div>
                        </div>

                        <div class="row m-t-10">
                            <div class="col-8">
                                <h5 class="m-0">API Access</h5>
                                <p class="m-b-0 text-muted"><small>Enable/Disable access</small></p>
                            </div>
                            <div class="col-4 text-right">
                                <input type="checkbox" checked data-plugin="switchery" data-color="#1bb99a"
                                    data-size="small" />
                            </div>
                        </div>

                        <div class="row m-t-10">
                            <div class="col-8">
                                <h5 class="m-0">Auto Updates</h5>
                                <p class="m-b-0 text-muted"><small>Keep up to date</small></p>
                            </div>
                            <div class="col-4 text-right">
                                <input type="checkbox" checked data-plugin="switchery" data-color="#1bb99a"
                                    data-size="small" />
                            </div>
                        </div>

                        <div class="row m-t-10">
                            <div class="col-8">
                                <h5 class="m-0">Online Status</h5>
                                <p class="m-b-0 text-muted"><small>Show your status to all</small></p>
                            </div>
                            <div class="col-4 text-right">
                                <input type="checkbox" checked data-plugin="switchery" data-color="#1bb99a"
                                    data-size="small" />
                            </div>
                        </div>

                    </div>
                </div>
            </div> <!-- end nicescroll -->
        </div> --}}
        <!-- /Right-bar -->

        <footer class="footer text-right">
            2021 - 2021 © H-Furniture.
        </footer>


    </div>
    <!-- END wrapper -->


    <script>
        var resizefunc = [];
    </script>

    <!-- jQuery  -->

    <script src="{{ asset('assets') }}/js/jquery.min.js"></script>
    <script src="{{ asset('assets') }}/js/popper.min.js"></script>
    <!-- Tether for Bootstrap -->
    <script src="{{ asset('assets') }}/js/bootstrap.min.js"></script>
    <script src="{{ asset('assets') }}/js/detect.js"></script>
    <script src="{{ asset('assets') }}/js/fastclick.js"></script>
    <script src="{{ asset('assets') }}/js/jquery.blockUI.js"></script>
    <script src="{{ asset('assets') }}/js/waves.js"></script>
    <script src="{{ asset('assets') }}/js/jquery.nicescroll.js"></script>
    <script src="{{ asset('assets') }}/js/jquery.scrollTo.min.js"></script>
    <script src="{{ asset('assets') }}/js/jquery.slimscroll.js"></script>
    <script src="{{ asset('assets') }}/plugins/switchery/switchery.min.js"></script>

    <!-- Counter Up  -->
    <script src="{{ asset('assets') }}/plugins/waypoints/lib/jquery.waypoints.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/counterup/jquery.counterup.min.js"></script>

    <!-- App js -->
    <script src="{{ asset('assets') }}/js/jquery.core.js"></script>
    <script src="{{ asset('assets') }}/js/jquery.app.js"></script>

    <!-- Page specific js -->
    @yield('jsScript')

</body>

</html>
