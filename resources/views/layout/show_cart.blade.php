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
    <title>Show Cart</title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}" />
    <!-- font awesome style -->
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
    <!-- responsive style -->
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
    @include('sweetalert::alert')
    <div class="hero_area">
        <!-- header section strats -->
        @include('layout.header')
        <!-- end header section -->
        <div class="table-responsive" style="margin: auto;text-align: center;width:80%">
            <table class="table table-bordered">
                <thead style="font-size: 20px;padding: 5px;background: skyblue">
                    <tr>
                        <th>Product Title</th>
                        <th>Product Quantity</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <?php $totalPrice = 0; ?>
                <tbody>
                    @if ($cart->isNotEmpty())
                        @foreach ($cart as $cart)
                            <tr>
                                <td>{{ $cart->product_title }}</td>
                                <td>{{ $cart->quantity }}</td>
                                <td>{{ $cart->price }}</td>
                                <td>
                                    @if ($cart->image != '')
                                        <img src="{{ asset('adm/uploads/product/' . $cart->image) }}" alt="Cart Image"
                                            style="width: 50px;height: 50px;" class="card-img-top">
                                    @else
                                        <img src="https://placehold.co/150x150?text=No Image" alt="No Image"
                                            style="width: 50px;height: 50px;" class="card-img-top">
                                    @endif
                                </td>
                                <td><a onclick="confirmation(event)" href="{{ route('remove_cart', $cart->id) }}"
                                        class="btn btn-danger">Remove Product</a></td>
                            </tr>
                            <?php $totalPrice = $totalPrice + $cart->price; ?>
                        @endforeach
                    @endif
                </tbody>
            </table>
            <div style="font-size: 20px;padding: 40px">
                <h2>Total Price : {{ $totalPrice }}</h2>
            </div>
            <div>
                <h1>Proceed to Order</h1>
                <a href="{{ route('cart_order') }}" class="btn btn-primary">Cash On Delivery</a>
                {{-- <a href="" class="btn btn-secondary">Pay Using Card</a> --}}
            </div>
        </div>
    </div>
    <!-- footer start -->
    <!-- footer end -->
    <!-- jQery -->
    <script>
        function confirmation(e) {
            e.preventDefault();
            var urlToRedirect = e.currentTarget.getAttribute('href');
            console.log(urlToRedirect);
            swal({
                    title: "Are you sure to cancel this product",
                    text: "You will not be able to revert this!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willCancel) => {
                    if (willCancel) {
                        window.location.href = urlToRedirect;
                    }
                });

        }
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
