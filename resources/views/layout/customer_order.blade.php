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
        <div class="table-responsive" style="margin: auto;text-align: center;width:80%">
            @include('message')
            <table class="table table-bordered">
                <thead style="font-size: 20px;padding: 5px;background: skyblue">
                    <tr>
                        <th>Product Title</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Payment Status</th>
                        <th>Delivered Status</th>
                        <th>Image</th>
                        <th>Cancel Order</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($order->isNotEmpty())
                        @foreach ($order as $order)
                            <tr>
                                <td>{{ $order->product_title }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>{{ $order->price }}</td>
                                <td>{{ $order->payment_status }}</td>
                                <td>{{ $order->deliver_status }}</td>
                                <td>
                                    @if ($order->image != '')
                                        <img src="{{ asset('adm/uploads/product/' . $order->image) }}" alt="Cart Image"
                                            style="width: 50px;height: 50px;" class="card-img-top">
                                    @else
                                        <img src="https://placehold.co/150x150?text=No Image" alt="No Image"
                                            style="width: 50px;height: 50px;" class="card-img-top">
                                    @endif
                                </td>
                                <td>
                                    @if ($order->deliver_status == 'processing')
                                        <a onclick="return confirm('Are You Want to Remove Order?')"
                                            href="{{ route('cancel_order', $order->id) }}"
                                            class="btn btn-danger">Cancel
                                            Order</a>
                                    @else
                                        <p style="color: blue">Not Allowed</p>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
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
