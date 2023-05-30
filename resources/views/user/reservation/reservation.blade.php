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
                    <form action="{{ URL::to(route('reservation')) }}" method="POST">
                        @csrf
                        <div class="row mt-2" style="padding-bottom: 20px">
                            <div class="col-md-12">
                                @if (session('message'))
                                    <p class="labels" style="text-align: center;font-size: 20px;color: black">{{ session('message') }}
                                    </p>
                                @endif
                                <label class="labels" style="font-size: 20px; color: black">Họ và
                                    tên</label>
                                <input type="text" name="name" class="form-control" style="color: black" required
                                    placeholder="Nhập vào họ và tên" value="{{$user->name ?? null}}">
                                <input type="hidden" name="phone" class="form-control" value="{{$phone}}">
                                <input type="hidden" name="user_id" class="form-control" value="{{$user->id ?? null}}">
                            </div>
                        </div>
                        <div class="row mt-2 pb-10" style="padding-bottom: 20px">
                            <div class="col-md-12"><label class="labels" style="font-size: 20px; color: black">Chọn dịch vụ</label>
                                <select class="form-control" onchange="loadTime()" required
                                        style="background-color: white; color: black" name="service_id">
                                    <option value=""> Chọn dịch vụ</option>
                                    @foreach ($services as $key => $service)
                                        <option value="{{ $service->id }}">{{ $service->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mt-2 pb-10" style="padding-bottom: 20px">
                            <div class="col-md-12"><label class="labels" style="font-size: 20px; color: black">Chọn bác
                                    sĩ</label>
                                <select class="form-control" onchange="loadTime()" required
                                        style="background-color: white; color: black" name="doctor_id">
                                    <option value=""> Chọn bác sĩ</option>
                                    @foreach ($doctors as $key => $doctor)
                                        <option value="{{ $doctor->id }}">{{$doctor->levelDoctor->name}}
                                            - {{ $doctor->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mt-2 pb-10" style="padding-bottom: 20px">
                            <div class="col-md-12"><label class="labels" style="font-size: 20px; color: black">Chọn
                                    ngày</label>
                                <input type="date" name="date" onchange="loadTime()" class="form-control"
                                       style="color: black" required placeholder="Chọn ngày"
                                       value="{{$user->name ?? null}}">
                            </div>
                        </div>
                        <div class="row mt-2 pb-10" id="time" style="padding-bottom: 30px">

                        </div>
                    </form>
                </div>
                <div class="col-3"></div>
            </div>
        </div>
    </div>

    <script>
        var today = new Date().toISOString().split('T')[0];
        document.getElementsByName("date")[0].setAttribute('min', today);

        function loadTime() {
            var doctor_id = document.getElementsByName("doctor_id")[0].value
            var date = document.getElementsByName("date")[0].value
            var service = document.getElementsByName("service_id")[0].value
            var time = document.getElementById("time");
            while (time.firstChild) {
                time.removeChild(time.firstChild);
            }
            if (doctor_id && date && service) {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        var res = JSON.parse(this.responseText)
                        console.log(res.data)
                        var time = document.getElementById("time");
                        if (res.data.length != 0) {
                            var title = document.createElement("div");
                            var data = document.createElement("div");
                            var mess = document.createElement("div");
                            var submit = document.createElement("div");
                            title.innerHTML = '<div class="col-md-12"><label class="labels" style="font-size: 20px; color: black">Chọn thời gian</label></div>'
                            time.appendChild(title);

                            res.data.forEach(function (value, index) {
                                data.innerHTML += '<div class="form-check form-check-inline col-2" style="margin-right: 0!important; color:black"> <input class="form-check-input" type="radio" name="time" value="' + value + '"> <label class="form-check-label" for="inlineCheckbox1">' + value + '</label> </div>'
                            })
                            time.appendChild(data);

                            mess.innerHTML = '<div class="col-md-12"><label class="labels" style="font-size: 20px; color: black">Lời nhắn</label> <textarea class="form-control" name="message" rows = "2" > </textarea>'
                            time.appendChild(mess);

                            submit.innerHTML = '<div class="col-md-12" style=" text-align: center; padding-top: 20px; border-radius: 10px"><button class="btn-danger" type="submit">Đặt lịch</button></div>'
                            time.appendChild(submit);
                        } else {
                            var response = document.createElement("div");
                            response.innerHTML = '<div class="col-md-12" style=" text-align: center; padding-top: 20px; border-radius: 10px"><label class="labels" style="font-size: 20px; color: black">Đã hết thời gian rảnh hãy thử lại với thời gian khác</label></div>'
                            time.appendChild(response);
                        }

                    }
                };
                xhttp.open("get", "/getFreeTime?doctor_id=" + doctor_id + "&date=" + date  + "&service_id=" + service, true);
                xhttp.send();
            }
        }
    </script>
@endsection
