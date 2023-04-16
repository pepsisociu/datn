@extends('user.layout')
@section('user_content')
    <!-- Open Content -->
    <section class="bg-light" id="article">
        <div class="container pb-5">
            <div class="row">
                <div class="col-lg-5 mt-5">
                    <div class="card mb-3">
                        <img class="card-img img-fluid" src="{{ asset('' . $product->image) }}" alt="Card image cap"
                            id="product-detail" />
                    </div>
                    <div class="row">
                        <!--Start Controls-->
                        <div class="col-1 align-self-center">
                            <a href="#multi-item-example" role="button" data-bs-slide="prev">
                                <i class="text-dark fas fa-chevron-left"></i>
                                <span class="sr-only">Previous</span>
                            </a>
                        </div>
                        <!--End Controls-->
                        <!--Start Carousel Wrapper-->
                        <div id="multi-item-example" class="col-10 carousel slide carousel-multi-item"
                            data-bs-ride="carousel">
                            <!--Start Slides-->
                            <div class="carousel-inner product-links-wap" role="listbox">
                                <!--First slide-->
                                @if($product->detailProduct->count() > 0)
                                <div class="carousel-item active">
                                    <div class="row">
                                        <div class="col-4">
                                            <a href="#">
                                                <img class="card-img img-fluid" src=" @if(isset ($product->image)){{ asset('' . $product->image) }} @else {{ asset('' . Config::get('app.image.default')) }} @endif"
                                                    alt="Product Image 1" />
                                            </a>
                                        </div>
                                        @if(isset($product->detailProduct))
                                        @foreach ($product->detailProduct->sortByDesc('id') as $key => $detail)
                                        @if ($key < 2)
                                        <div class="col-4">
                                            <a href="#">
                                                <img class="card-img img-fluid" src=" @if(isset ($detail->image)){{ asset('' . $detail->image) }} @else {{ asset('' . Config::get('app.image.default')) }} @endif"
                                                    alt="Product Image 1" />
                                            </a>
                                        </div>
                                        @endif
                                        @endforeach
                                        @endif
                                    </div>
                                </div>
                                @endif
                                <!--/.First slide-->

                                <!--Second slide-->
                                @if(count($product->detailProduct) >3)
                                <div class="carousel-item">
                                    <div class="row">
                                        @if(isset($product->detailProduct))
                                        @foreach ($product->detailProduct->sortByDesc('id') as $key => $detail)
                                        @if ($key >= 2 && $key <5)
                                        <div class="col-4">
                                            <a href="#">
                                                <img class="card-img img-fluid" src=" @if(isset ($detail->image)){{ asset('' . $detail->image) }} @else {{ asset('' . Config::get('app.image.default')) }} @endif"
                                                    alt="Product Image 1" />
                                            </a>
                                        </div>
                                        @endif
                                        @endforeach
                                        @endif
                                    </div>
                                </div>
                                @endif
                                <!--/.Second slide-->
                            </div>
                            <!--End Slides-->
                        </div>
                        <!--End Carousel Wrapper-->
                        <!--Start Controls-->
                        <div class="col-1 align-self-center">
                            <a href="#multi-item-example" role="button" data-bs-slide="next">
                                <i class="text-dark fas fa-chevron-right"></i>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                        <!--End Controls-->
                    </div>
                </div>
                <div class="col-lg-7 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="h2">{{ $product->name }}</h1>
                            <ul class="list-unstyled d-flex justify-content-between">
                                <?php $now = Carbon\Carbon::now()->toDateTimeString() ?>
                                @if ($now <= $product->end_promotion && $now >= $product->start_promotion)
                                    <li class="text-right text-dark" style="font-weight: bold!important; font-size: 25px!important;">
                                        {{ Lang::get('message.before_unit_money') . number_format($product->price_down, 0, ',', '.') . Lang::get('message.after_unit_money') }}
                                    </li>
                                    <li class="text-right text-dark" style="text-decoration: line-through; font-size: 25px!important;">
                                        {{ Lang::get('message.before_unit_money') . number_format($product->price, 0, ',', '.') . Lang::get('message.after_unit_money') }}
                                    </li>
                                @else
                                    <li class="text-right text-dark" style="font-weight: bold!important; font-size: 25px!important;">
                                        {{ Lang::get('message.before_unit_money') . number_format($product->price, 0, ',', '.') . Lang::get('message.after_unit_money') }}
                                    </li>
                                @endif
                            </ul>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <h6>Thương hiệu:</h6>
                                </li>
                                <li class="list-inline-item">
                                    <p><strong>{{ $product->brand->name }}</strong></p>
                                </li>
                            </ul>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <h6>Danh mục:</h6>
                                </li>
                                <li class="list-inline-item">
                                    <p><strong>{{ $product->category->name }}</strong></p>
                                </li>
                            </ul>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <h6>Còn lại:</h6>
                                </li>
                                <li class="list-inline-item">
                                    <p><strong>{{ $product->quantity }}</strong></p>
                                </li>
                            </ul>
                            <h6>Chi tiết:</h6>
                            <p>
                                {{ $product->short_description }}
                            </p>
                            @if ($product->active == 0 || $product->is_deleted == 1)
                            <p class="noti">{{ Lang::get('message.no_long_in_business') }}</p>
                            @elseif ($product->quantity <= 0)
                            <p class="noti">{{ Lang::get('message.out_of_stock') }}</p>
                            @else
                            <form action="{{ URL::to(route('add_cart', ['id' => $product->id])) }}" method="POST">
                                @csrf
                                <input type="hidden" name="product-title" value="Activewear" />
                                <div class="row">
                                    <div class="col-auto">
                                        <ul class="list-inline pb-3">
                                            <li class="list-inline-item text-right">
                                                Số lượng
                                                <input type="number" name="quanity" min="1" required id="product_quantity" value="1" />
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row pb-3">
                                    <div class="col d-grid">
                                        <button type="button" class="btn btn-success btn-lg" id="buy">
                                            Mua ngay
                                        </button>
                                    </div>
                                    <div class="col d-grid">
                                        <button type="submit" class="btn btn-success btn-lg" name="submit" value="addtocard">
                                            Thêm vào giỏ hàng
                                        </button>
                                    </div>
                                </div>
                            </form>
                            @endif
                            @if (session('message'))
                                <p class="noti">{{ session('message') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Close Content -->
    <div class="m-5">
        <div class="container">
            @if (Auth::check() && Auth::user()->role->name === Config::get('auth.roles.user'))
                <form action="{{ URL::to(route('comment', ['id' => $product->id])) }}" method="POST">
                    @csrf
                    <div class="text-area d-flex">
                        <textarea class="form-control" cols="1" placeholder="Nhận xét" name="description" required></textarea>
                        <button type="submit" class="btn btn-primary">Gửi</button>
                    </div>
                </form>
            @endif
            <div class="py-2">
                <div class="list-comment">
                    @if (isset($comments))
                        @foreach ($comments as $key => $comment)
                            <div class="d-flex comment-item m-3 align-items-center">
                                <i class="fas fa-user px-2 ico-user"></i>
                                <div>
                                    @if (Auth::check() && $comment->user->id === Auth::user()->id && Auth::user()->role->name === Config::get('auth.roles.user'))
                                        <p class="m-0 txt-name">Bạn</p>
                                    @else
                                        <p class="m-0 txt-name">{{ $comment->user->name }}</p>
                                    @endif
                                    <p class="m-0">{{ $comment->description }}</p>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
    <form style="display: none" action="{{ URL::to(route('buy_product', ['id' => $product->id])) }}" method="post" id="buy_now"> 
        @csrf
        <input type="number" name="quanity" min="1" required id="product_qty" />
    </form>
    <script type="text/javascript">
        const button = document.getElementById('buy');
        const form = document.getElementById('buy_now');
        const qty = document.getElementById('product_qty');
        const pro_qty = document.getElementById('product_quantity');
        button.addEventListener('click', event => {
            qty.value= pro_qty.value
            form.submit()
        });
    </script>
@endsection