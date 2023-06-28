@extends('doctor.layout')
@section('doctor_content')
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4" style=" background-color: black; ">
        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="info">
                    <a class="d-block">Bác sĩ: {{ auth()->user()->name }}</a>
                </div>
            </div>
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-item">
                        <a href="{{ URL::to(route('screen_home_doctor')) }}" class="nav-link active">
                            <i class="nav-icon fas fa-calendar-alt"></i>
                            <p>Quản lý lịch hẹn</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ URL::to(route('doctor_account')) }}" class="nav-link">
                            <i class="nav-icon fas fa-address-book"></i>
                            <p>Đổi mật khẩu</p>
                        </a>
                    </li>
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
                        <h1 class="m-0">Lịch hẹn</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            @if (session('message'))
                                <div class="card-header">
                                    <p class="noti">{{ session('message') }}</p>
                                </div>
                            @endif
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form action="{{ URL::to(route('screen_home_doctor')) }}" method="GET">
                                    <div class="form-group row">
                                        <label>Chọn thời gian:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="far fa-calendar-alt"></i>
                                                </span>
                                            </div>
                                            <input type="text" name="date" class="form-control float-right" id="reservation">
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-primary">Xác nhận</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Số thứ tự</th>
                                            <th>Ngày</th>
                                            <th>Tên bác sĩ</th>
                                            <th>Tên người đặt</th>
                                            <th>Dịch vụ</th>
                                            <th>Số điện thoại</th>
                                            <th>Thời gian</th>
                                            <th>Trạng thái</th>
                                            <th>Thời gian tái khám</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        @foreach ($reservations as $key => $reservation)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $reservation->date }}</td>
                                                <td>{{ $reservation->doctor->name }}</td>
                                                <td>{{ $reservation->user->name ?? $reservation->name }}</td>
                                                <td>{{ $reservation->service->name ?? null}}</td>
                                                <td>{{ $reservation->user->phone ?? $reservation->phone }}</td>
                                                <td>{{ $reservation->time }}</td>
                                                <td>{{ $reservation->status == 1 ? 'Xác nhận' : 'Hủy' }}</td>
                                                <td>{{ $reservation->date_recheck }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
    </div>
@endsection
