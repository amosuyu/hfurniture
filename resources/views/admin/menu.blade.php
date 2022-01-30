<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <ul>
                <li class="has_sub">
                    <a href="{{route('dashboard')}}" class="waves-effect"><span
                            class="label label-pill label-primary float-right">1</span><i
                            class="zmdi zmdi-view-dashboard"></i><span> Bảng điều khiển </span> </a>
                </li>
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-network"></i> <span>Không gian
                        </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('khong-gian.index') }}">Danh sách không gian</a></li>
                        <li><a href="{{ route('khong-gian.create') }}">Thêm không gian</a></li>
                    </ul>
                </li>
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-network"></i> <span> Bộ sưu tập
                        </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('bo-suu-tap.index') }}">Danh sách bộ sưu tập</a></li>
                        <li><a href="{{ route('bo-suu-tap.create') }}">Thêm bộ sưu tập</a></li>
                    </ul>
                </li>
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-network"></i> <span> Loại sản phẩm
                        </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('loai-san-pham.index') }}">Danh sách loại sản phẩm</a></li>
                        <li><a href="{{ route('loai-san-pham.create') }}">Thêm loại sản phẩm</a></li>
                    </ul>
                </li>
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-network"></i> <span> Sản phẩm
                        </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('san-pham.index') }}">Danh sách sản phẩm</a></li>
                        <li><a href="{{ route('san-pham.create') }}">Thêm sản phẩm</a></li>
                    </ul>
                </li>
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-network"></i> <span>Màu sắc
                        </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('mau-sac.index') }}">Danh sách màu sắc</a></li>
                        <li><a href="{{ route('mau-sac.create') }}">Thêm màu</a></li>
                    </ul>
                </li>
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-network"></i> <span>Đơn hàng
                        </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('don-hang.index') }}">Danh sách đơn hàng</a></li>
                    </ul>
                </li>
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-network"></i> <span> Tài khoản
                        </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('tai-khoan.index') }}">Danh sách tài khoản</a></li>
                    </ul>
                </li>
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-network"></i> <span> Loại blog
                        </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('loai-blog.index') }}">Danh sách loại blog</a></li>
                        <li><a href="{{ route('loai-blog.create') }}">Thêm loai blog</a></li>
                    </ul>
                </li>
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-network"></i> <span> Blog
                        </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('blog.index') }}">Danh sách blog</a></li>
                        <li><a href="{{ route('blog.create') }}">Thêm blog</a></li>
                    </ul>
                </li>
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-network"></i> <span> Vouchers
                        </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('giam-gia.index') }}">Danh sách vouchers</a></li>
                        <li><a href="{{ route('giam-gia.create') }}">Thêm vouchers</a></li>
                    </ul>
                </li>

                

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-network"></i> <span> Chính sách
                        </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('chinh-sach.index') }}">Danh sách chính sách</a></li>
                        <li><a href="{{ route('chinh-sach.create') }}">Thêm chính sách</a></li>
                    </ul>
                </li>
               
            </ul>
            <div class="clearfix"></div>
        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>
    </div>

</div>
