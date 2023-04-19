@extends('user.layout')
@section('user_content')
    <div class="container-fluid bg-primary py-5 bg-header" style="margin-bottom: 90px;">
        <div class="row py-5">
            <div class="col-12 pt-lg-5 mt-lg-5 text-center">
                <h1 class="display-4 text-white animated zoomIn">Đặt lịch</h1>
            </div>
        </div>
    </div>

    <div class="container-fluid py-1 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-1">
            <div class="row g-5">
                <div class="col-3"></div>
                <div class="col-6" style="background-color: skyblue!important; border-radius: 25px">
                    <form action="{{ URL::to(route('update_info')) }}" method="POST">
                        @csrf
                        <div class="row mt-2" style="padding-bottom: 20px">
                            <div class="col-md-12"><label class="labels" style="font-size: 20px; color: black">Họ và tên</label>
                                <input type="text" name="name" class="form-control" style="color: black" required placeholder="Nhập vào họ và tên" value="{{$user->name ?? null}}">
                                <input type="hidden" name="phone" class="form-control" value="{{$phone}}">
                            </div>
                        </div>
                        <div class="row mt-2 pb-10" style="padding-bottom: 20px">
                            <div class="col-md-12"><label class="labels" style="font-size: 20px; color: black">Chọn bác sĩ</label>
                                <select class="form-control" onchange="loadTime()" required style="background-color: white; color: black" name="doctor_id">
                                    <option  value=""> Chọn bác sĩ </option>
                                    @foreach ($doctors as $key => $doctor)
                                        <option value="{{ $doctor->id }}"> {{ $doctor->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mt-2 pb-10" style="padding-bottom: 20px">
                            <div class="col-md-12"><label class="labels" style="font-size: 20px; color: black">Chọn ngày</label>
                                <input type="date" name="date" onchange="loadTime()" class="form-control" style="color: black" required placeholder="Chọn ngày" value="{{$user->name ?? null}}">
                            </div>
                        </div>
                        <div class="row mt-2 pb-10" id="time" style="padding-bottom: 30px">
                            <div class="col-md-12"><label class="labels" style="font-size: 20px; color: black">Chọn thời gian</label>
                                <input type="date" name="date" onchange="loadTime()" class="form-control" style="color: black" required placeholder="Chọn ngày" value="{{$user->name ?? null}}">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-3"></div>
            </div>
        </div>
    </div>

    <script>
    function loadTime() {
        var doctor_id = document.getElementsByName("doctor_id")[0].value
        var date = document.getElementsByName("date")[0].value
        if (doctor_id && date) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText)
                }
            };
            xhttp.open("get", "/getFreeTime?doctor=" + doctor_id + "&date=" + date, true);
            xhttp.send();
        }
    }
    </script>
@endsection
