@extends('user.layout')
@section('user_content')
    <!-- Start Content -->
    <div class="container py-5" id="shop">
        <div class="row">
            <div class="col-lg-3">
                <h1 class="h2 pb-4">Lọc theo</h1>
                <form method="GET" action="{{ URL::to(route('search_products')) }}">
                    <input type="text" class="form-control" placeholder="Tìm kiếm" name="product"
                        @if ($request->product) value = "{{ $request->product }}" @endif>
                    <select class="filter-select py-2 my-2" name="category">
                        <option selected value="">Chọn danh mục</option>
                        @foreach ($categories as $key => $category)
                            <option value="{{ $category->id }}" @if ($request->category == $category->id) selected @endif>
                                {{ $category->name }}</option>
                        @endforeach
                    </select>
                    <select class="filter-select py-2 my-2" name="brand">
                        <option selected value="">Chọn thương hiệu</option>
                        @foreach ($brands as $key => $brand)
                            <option value="{{ $brand->id }}" @if ($request->brand == $brand->id) selected @endif>
                                {{ $brand->name }}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-primary" type="submit">Tìm kiếm</button>
                </form>
            </div>

            <div class="col-lg-9">
                @if (session('message'))
                    <p class="noti">{{ session('message') }}</p>
                @endif
                <div class="row">
                    @foreach ($products as $key => $product)
                        <div class="col-md-4 pb-3">
                            <div class="card mb-4 product-wap rounded-0">
                                <div class="card rounded-0">
                                    <div class="shop-image">
                                        <img class="card-img rounded-0 img-fluid"
                                            src="{{ asset('' . $product->image) }}" />
                                    </div>
                                    <div
                                        class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                                        <ul class="list-unstyled">
                                            <li>
                                                <a class="btn btn-success text-white mt-2"
                                                    href="{{ URL::to(route('detail_product', ['id' => $product->id])) }}"><i
                                                        class="far fa-eye"></i></a>
                                            </li>
                                            <li>
                                                <form action="{{ URL::to(route('add_cart', ['id' => $product->id])) }}"
                                                    method="POST">
                                                    @csrf
                                                    <input type="hidden" name="quanity" id="product_quantity" value="1" />
                                                    <button class="btn btn-success text-white mt-2" type="submit"><i
                                                            class="fas fa-cart-plus"></i></button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <p class="text-center" style="height: 54px;">
                                        <a href="{{ URL::to(route('detail_product', ['id' => $product->id])) }}" style="font-weight: bold!important"
                                            class="h3 text-decoration-none">{{ $product->name }}
                                        </a>
                                    </p>
                                    <ul class="list-unstyled d-flex justify-content-between">
                                        <?php $now = Carbon\Carbon::now()->toDateTimeString() ?>
                                        @if ($now <= $product->end_promotion && $now >= $product->start_promotion)
                                            <li class="text-right text-dark" style="font-weight: bold!important">
                                                {{ Lang::get('message.before_unit_money') . number_format($product->price_down, 0, ',', '.') . Lang::get('message.after_unit_money') }}
                                            </li>
                                            <li class="text-right text-dark" style="text-decoration: line-through">
                                                {{ Lang::get('message.before_unit_money') . number_format($product->price, 0, ',', '.') . Lang::get('message.after_unit_money') }}
                                            </li>
                                        @else
                                            <li class="text-right text-dark" style="font-weight: bold!important">
                                                {{ Lang::get('message.before_unit_money') . number_format($product->price, 0, ',', '.') . Lang::get('message.after_unit_money') }}
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- End Content -->

    <section class="py-5" style="margin-top:24px">
        <div class="container my-4">
            <div class="row text-center py-3">
                <div class="col-lg-6 m-auto">

                </div>
                <div class="col-lg-9 m-auto tempaltemo-carousel">
                    <div class="row d-flex flex-row">
                        <!--Controls-->
                        <div class="col-1 align-self-center">

                        </div>
                        <!--End Controls-->

                        <!--Carousel Wrapper-->
                        <div class="col">

                        </div>
                        <!--End Carousel Wrapper-->

                        <!--Controls-->
                        <div class="col-1 align-self-center">

                        </div>
                        <!--End Controls-->
                    </div>
                </div>
            </div>
        </div>
        <div class="container my-4">
            <div class="row text-center py-3">
              <div class="col-lg-6 m-auto">
               
              </div>
              <div class="col-lg-9 m-auto tempaltemo-carousel">
                <div class="row d-flex flex-row">
                  <!--Controls-->
                  <div class="col-1 align-self-center">
                    
                  </div>
                  <!--End Controls-->
    
                  <!--Carousel Wrapper-->
                  <div class="col">
                   
                  </div>
                  <!--End Carousel Wrapper-->
    
                  <!--Controls-->
                  <div class="col-1 align-self-center">
                    
                  </div>
                  <!--End Controls-->
                </div>
              </div>
            </div>
          </div>
    </section>
@endsection
