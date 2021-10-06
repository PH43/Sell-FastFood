<!-- Sidebar -->
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{URL::to('/admin')}}"  class="brand-link">

        <span class="brand-text font-weight-light" style="padding-left: 30px">Trang Admin</span>
    </a>
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">

        <div class="info" style="display: flex">
            @if(auth()->check())
                <a href="#" class="d-block" style="padding-left: 30px">{{ auth()->user()->name }}</a>
                <a href="{{ route('admins.log_out') }}" style="margin-left: 20px">Đăng xuất</a>
            @endif
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->

            <li class="nav-item">
                <a href="{{ route('categories.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Quản lý danh mục
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('products.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                       Quản lý sản phẩm
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('users.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Quản lý tài khoản
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('roles.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Quản lý phân quyền
                    </p>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>
