@extends('admin.layout')
@section('admin_content')
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4" style=" background-color: black; ">
        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="info">
                    <a class="d-block">{{ auth()->user()->name }}</a>
                </div>
            </div>
            <!-- SidebarSearch Form -->
{{--            <div class="form-inline">--}}
{{--                <div class="input-group" data-widget="sidebar-search">--}}
{{--                    <input class="form-control form-control-sidebar" type="search" placeholder="Tìm kiếm"--}}
{{--                        aria-label="Search">--}}
{{--                    <div class="input-group-append">--}}
{{--                        <button class="btn btn-sidebar">--}}
{{--                            <i class="fas fa-search fa-fw"></i>--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="{{ URL::to(route('screen_admin_home')) }}" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Trang chủ</p>
                        </a>
                    </li>
                    @if(auth()->user()->role->name !== Config::get('auth.roles.doctor'))
                        <li class="nav-header">Thông tin</li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-bookmark"></i>
                                <p>
                                    Thương hiệu
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ URL::to(route('admin.brand.index')) }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Danh sách thương hiệu</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ URL::to(route('admin.brand.create')) }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Thêm thương hiệu</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Danh mục sản phẩm
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ URL::to(route('admin.category.index')) }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Danh sách danh mục</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ URL::to(route('admin.category.create')) }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Thêm danh mục</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-list-ul"></i>
                                <p>
                                    Sản phẩm
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ URL::to(route('admin.product.index')) }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Danh sách sản phẩm</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ URL::to(route('admin.product.create')) }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Thêm sản phẩm</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-user-md"></i>
                                <p>
                                    Bác sĩ
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ URL::to(route('admin.doctor.index')) }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Danh sách bác sĩ</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ URL::to(route('admin.doctor.create')) }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Thêm bác sĩ</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-server"></i>
                                <p>
                                    Dịch vụ
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ URL::to(route('admin.service.index')) }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Danh sách dịch vụ</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ URL::to(route('admin.service.create')) }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Thêm dịch vụ</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{ URL::to(route('admin.reservation.index')) }}" class="nav-link">
                                <i class="nav-icon fas fa-calendar-alt"></i>
                                <p>Quản lý lịch hẹn</p>
                            </a>
                        </li>
                        <li class="nav-header">Hóa đơn</li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-file-download"></i>
                                <p>
                                    Hóa đơn nhập
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ URL::to(route('admin.invoice_import.index')) }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Danh sách hóa đơn</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ URL::to(route('admin.invoice_import.create')) }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Nhập hàng</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{ URL::to(route('admin.invoice_export.order')) }}" class="nav-link">
                                <i class="nav-icon fas fa-paste"></i>
                                <p>Đơn đặt hàng</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ URL::to(route('admin.invoice_export.invoice')) }}" class="nav-link active">
                                <i class="nav-icon fas fa-file-export"></i>
                                <p>Hóa đơn bán</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ URL::to(route('admin.invoice_export.close_orders')) }}" class="nav-link">
                                <i class="nav-icon fas fa-times-circle"></i>
                                <p>Đơn đã hủy</p>
                            </a>
                        </li>
                        <li class="nav-header">Thống kê</li>
                        <li class="nav-item">
                            <a href="{{ URL::to(route('admin.statistical.products')) }}" class="nav-link">
                                <i class="nav-icon fas fa-chart-bar"></i>
                                <p>Thống kê sản phẩm</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ URL::to(route('admin.statistical.invoices')) }}" class="nav-link">
                                <i class="nav-icon fas fa-file-invoice-dollar"></i>
                                <p>Thống kê hóa đơn</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ URL::to(route('admin.statistical.users')) }}" class="nav-link">
                                <i class="nav-icon fas fa-id-card-alt"></i>
                                <p>Thống kê khách hàng</p>
                            </a>
                        </li>
                        @if (auth()->user()->role->name === Config::get('auth.roles.manager'))
                            <li class="nav-header">Tài khoản</li>
                            <li class="nav-item">
                                <a href="{{ URL::to(route('admin.account.index')) }}" class="nav-link">
                                    <i class="nav-icon fas fa-address-book"></i>
                                    <p>Danh sách tài khoản</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ URL::to(route('admin.account.create')) }}" class="nav-link">
                                    <i class="nav-icon fas fa-user-plus"></i>
                                    <p>Cấp tài khoản mới</p>
                                </a>
                            </li>
                            {{--                        <li class="nav-item">--}}
    {{--                            <a href="#" class="nav-link">--}}
    {{--                                <i class="nav-icon fas fa-sliders-h"></i>--}}
    {{--                                <p>--}}
    {{--                                    Slidebar--}}
    {{--                                    <i class="right fas fa-angle-left"></i>--}}
    {{--                                </p>--}}
    {{--                            </a>--}}
    {{--                            <ul class="nav nav-treeview">--}}
    {{--                                <li class="nav-item">--}}
    {{--                                    <a href="{{ URL::to(route('admin.sidebar.index')) }}" class="nav-link">--}}
    {{--                                        <i class="far fa-circle nav-icon"></i>--}}
    {{--                                        <p>Danh sách slider</p>--}}
    {{--                                    </a>--}}
    {{--                                </li>--}}
    {{--                                <li class="nav-item">--}}
    {{--                                    <a href="{{ URL::to(route('admin.sidebar.create')) }}" class="nav-link">--}}
    {{--                                        <i class="far fa-circle nav-icon"></i>--}}
    {{--                                        <p>Thêm Slider</p>--}}
    {{--                                    </a>--}}
    {{--                                </li>--}}
    {{--                            </ul>--}}
    {{--                        </li>--}}
                        @endif
                    @endif
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Thông tin hóa đơn {{ $invoice->code_invoice }}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ URL::to(route('screen_admin_home')) }}">Trang
                                    chủ</a></li>
                            <li class="breadcrumb-item active">Hóa đơn</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        @if (session('message'))
                            <div class="card-header">
                                <p class="noti">{{ session('message') }}</p>
                            </div>
                        @endif
                        <!-- Main content -->
                        <div class="invoice p-3 mb-3">
                            <!-- Table row -->
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Số thứ tự</th>
                                                <th>Sản phẩm</th>
                                                <th>Số lượng</th>
                                                <th>Đơn giá</th>
                                                <th>Thành tiền</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            @foreach ($invoice->detailInvoiceExport->sortByDesc('created_at') as $key => $detailInvoiceExport)
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td> {{ $detailInvoiceExport->product->name }}</td>
                                                    <td> {{ number_format($detailInvoiceExport->quantity, 0, ',', '.') }}
                                                    </td>
                                                    <td> {{ Lang::get('message.before_unit_money') . number_format($detailInvoiceExport->product->price, 0, ',', '.') . Lang::get('message.after_unit_money') }}
                                                    </td>
                                                    <td> {{ Lang::get('message.before_unit_money') . number_format($detailInvoiceExport->into_money, 0, ',', '.') . Lang::get('message.after_unit_money') }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                            <div class="row">
                                <div class="col-6"></div>
                                <div class="col-6">
                                    <p class="lead">Thông tin hóa đơn </p>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <th style="width:50%">Tổng tiền</th>
                                                <td> {{ Lang::get('message.before_unit_money') . number_format($invoice->into_money, 0, ',', '.') . Lang::get('message.after_unit_money') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th style="width:50%">Khách hàng</th>
                                                <td> {{ $invoice->name_user }}</td>
                                            </tr>
                                            <tr>
                                                <th style="width:50%">Số điện thoại</th>
                                                <td> {{ $invoice->phone_user }}</td>
                                            </tr>
                                            <tr>
                                                <th style="width:50%">Phương thức thanh toán</th>
                                                <td>
                                                    @if ($invoice->is_pay_cod)
                                                        {{ Lang::get('message.pay_cod') }}
                                                    @else
                                                        {{ Lang::get('message.pay_online') }}
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th style="width:50%">Trạng thái thanh toán</th>
                                                <td>
                                                    @if ($invoice->is_payment)
                                                        {{ Lang::get('message.paid') }}
                                                    @else
                                                        {{ Lang::get('message.pay_not') }}
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th style="width:50%">Thông tin đơn hàng</th>
                                                <td> {{ $invoice->status_ship }}</td>
                                            </tr>
                                            <tr>
                                                <th style="width:50%">Tiền cần thanh toán</th>
                                                <td> {{ Lang::get('message.before_unit_money') . number_format($invoice->need_pay, 0, ',', '.') . Lang::get('message.after_unit_money') }}</td>
                                            </tr>
                                            <tr>
                                                <th style="width:50%">Thông tin thêm</th>
                                                <td> {{ $invoice->message }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.invoice -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
