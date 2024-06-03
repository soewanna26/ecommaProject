@extends('admin.layout.app')
@section('title', 'Order')

@section('main')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                @include('message')
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <h4 class="card-title" style="margin: 0;">Order</h4>

                    <div style="display: flex; justify-content: center; align-items: center">
                        <form action="{{ route('admin.searchOrder') }}" style="display: flex; align-items: center;"
                            method="GET">
                            @csrf
                            <input type="text" name="search" id="search" value="{{ Request::get('search') }}"
                                placeholder="Search For Something" class="form-control"
                                style="flex: 1; margin-right: 8px;color:white">
                            <input type="submit" value="Search" class="btn btn-outline-primary">
                        </form>
                        <a href="{{ route('admin.order') }}" class="btn btn-outline-secondary ml-1">Reset</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Product Title</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Payment Status</th>
                                <th>Delivery Status</th>
                                <th>Image</th>
                                <th>Order Date</th>
                                <th>Delivered</th>
                                <th>Print PDF</th>
                                <th>Send Mail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $order)
                                <tr>
                                    <td>{{ $order->name }}</td>
                                    <td>{{ $order->email }}</td>
                                    <td>{{ $order->phone }}</td>
                                    <td>{{ $order->address }}</td>
                                    <td>{{ $order->product_title }}</td>
                                    <td>{{ $order->quantity }}</td>
                                    <td>{{ $order->price }}</td>
                                    <td>{{ $order->payment_status }}</td>
                                    <td>{{ $order->deliver_status }}</td>
                                    <td>
                                        @if ($order->image != '')
                                            <img src="{{ asset('adm/uploads/product/' . $order->image) }}"
                                                alt="product Image" style="width: 50px;height: 50px;" class="card-img-top">
                                        @else
                                            <img src="https://placehold.co/150x150?text=No Image" alt="No Image"
                                                style="width: 50px;height: 50px;" class="card-img-top">
                                        @endif
                                    </td>
                                    <td> {{ \Carbon\Carbon::parse($order->created_at)->format('d M,Y') }} </td>
                                    <td>
                                        @if ($order->deliver_status == 'processing')
                                            <a href="{{ route('admin.delivered', $order->id) }}" class="btn btn-primary"
                                                onclick="return confirm('Are u sure this product is delivered !!')">Delivered</a>
                                        @else
                                            <p style="color: green">Delivered</p>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.print_pdf', $order->id) }}"
                                            class="btn btn-secondary">Print</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.send_mail', $order->id) }}"><i
                                                class="mdi mdi-send"></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="15" class="text-center text-bold">
                                        Order Not Found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div>
                        @if ($orders->isNotEmpty())
                            {{ $orders->links() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
