@extends('admin.layout.app')
@section('title', 'Product')

@section('main')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                @include('message')
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <h4 class="card-title" style="margin: 0;">Product</h4>
                    <a href="{{ route('admin.add_product') }}" style="text-decoration: none;">Add Product</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Product Title</th>
                                <th>Category</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Discount Price</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($products->isNotEmpty())
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->title }}</td>
                                        <td> {{$product->category->category_name}} </td>
                                        <td>{{ $product->quantity }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>{{ $product->discount_price ? $product->discount_price : 0 }}</td>
                                        <td>{{ Str::words(strip_tags($product->description ? $product->description : " - "),5) }}</td>
                                        <td>
                                            @if ($product->image != '')
                                                <img src="{{ asset('adm/uploads/product/' . $product->image) }}"
                                                    alt="product Image" style="width: 50px;height: 50px;" class="card-img-top">
                                            @else
                                                <img src="https://placehold.co/150x150?text=No Image" alt="No Image"
                                                    style="width: 50px;height: 50px;" class="card-img-top">
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.edit_product', $product->id) }}"
                                                class="btn btn-info btn-sm"><i class="fa-regular fa-pen-to-square"></i>
                                            </a>
                                            <a href="{{ route('admin.delete_product', $product->id) }}"
                                                onclick="return confirm('Are you sure you want to delete {{ $product->title }}?')"
                                                class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <div>
                        @if ($products->isNotEmpty())
                            {{ $products->links() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
