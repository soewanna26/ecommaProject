<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="images/favicon.png" type="">
    <title>Product Detail</title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}" />
    <!-- font awesome style -->
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
    <!-- responsive style -->
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet" />
</head>

<body>
    @include('sweetalert::alert')
    <div class="hero_area">
        <!-- header section strats -->
        @include('layout.header')
        <!-- end header section -->

        <section class="inner_page_head">
            <div class="container_fuild">
                <div class="row">
                    <div class="col-md-12">
                        <div class="full">
                            <h3>Product Grid</h3>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="product_section layout_padding">
            <div class="container">
                <div class="heading_container heading_center">
                    <h2>
                        Our <span>products</span>
                    </h2>
                    <br><br>
                    <div>
                        <form action="{{ route('search_product') }}" method="GET">
                            @csrf
                            <input type="text" value="{{ Request::get('search') }}" style="width: 500px"
                                name="search" placeholder="Search for something">
                            <input type="submit" value="Search">
                        </form>
                    </div>
                </div>
                @include('message')
                <div class="row mb-3">
                    @if ($products->isNotEmpty())
                        @foreach ($products as $product)
                            <div class="col-sm-6 col-md-4 col-lg-4">
                                <div class="box">
                                    <div class="option_container">
                                        <div class="options">
                                            <a href="{{ route('product_detail', $product->id) }}" class="option1">
                                                Product Details
                                            </a>
                                            <form action="{{ route('add_cart', $product->id) }}" method="POST">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <input type="number" name="quantity" value="1"
                                                            min="1" style="width: 100%">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="submit" value="Add To Cart">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="img-box">
                                        <img src="{{ asset('adm/uploads/product/' . $product->image) }}" alt="">
                                    </div>
                                    <div class="detail-box">
                                        <h5>
                                            {{ $product->title }}
                                        </h5>
                                        @if ($product->discount_price != null)
                                            <h6 style="color: red">
                                                Discount Price <br>
                                                $ {{ $product->discount_price }}</h6>

                                            <h6 style="text-decoration: line-through;color: blue">
                                                Price <br>
                                                $ {{ $product->price }}</h6>
                                        @else
                                            <h6 style="color: blue">
                                                Price <br>
                                                $ {{ $product->price }}
                                            </h6>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                @if ($products->isNotEmpty())
                    {!! $products->links() !!}
                @endif
            </div>
        </section>
    </div>
    <!-- footer start -->
    @include('layout.footer')
    <!-- footer end -->
    <!-- jQery -->
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            var scrollpos = localStorage.getItem('scrollpos');
            if (scrollpos) window.scrollTo(0, scrollpos);
        });

        window.onbeforeunload = function(e) {
            localStorage.setItem('scrollpos', window.scrollY);
        };
    </script>
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <!-- popper js -->
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <!-- bootstrap js -->
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <!-- custom js -->
    <script src="{{ asset('js/custom.js') }}"></script>
</body>

</html>
