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
    <div class="hero_area">
        <!-- header section strats -->
        @include('layout.header')
        <!-- end header section -->

        <div class="col-sm-6 col-md-4 col-lg-4" style="margin: auto;width: 50%;padding: 30px;">
            @include('message')
            <div class="img-box" style="padding: 20px">
                <img src="{{ asset('adm/uploads/product/' . $product->image) }}" alt=""
                    style="width: 100%;
                       height: auto;
                       box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                       border-radius: 15px;
                       transition: transform 0.3s ease, box-shadow 0.3s ease;">
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
                <h6>Product Category : {{ $product->category->category_name }}</h6>
                <h6>Product Detail : {{ $product->description }}</h6>
                <h6>Product Quantity : {{ $product->quantity }}</h6>

                <form action="{{ route('add_cart', $product->id) }}" method="POST">
                    @csrf
                    <div class="row mt-2">
                        <div class="col-md-4">
                            <input type="number" name="quantity" value="1" min="1" style="width: 100%">
                        </div>
                        <div class="col-md-4">
                            <input type="submit" value="Add To Cart">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- footer start -->
    @include('layout.footer')
    <!-- footer end -->
    <!-- jQery -->
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <!-- popper js -->
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <!-- bootstrap js -->
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <!-- custom js -->
    <script src="{{ asset('js/custom.js') }}"></script>
</body>

</html>
