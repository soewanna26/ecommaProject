<section class="product_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Our <span>products</span>
            </h2>
            <br><br>
            <div>
                <form action="{{ route('product_search') }}" method="GET">
                    @csrf
                    <input type="text" value="{{ Request::get('search') }}" style="width: 500px" name="search"
                        placeholder="Search for something">
                    <input type="submit" value="Search">
                </form>
            </div>
        </div>
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
                                                <input type="number" name="quantity" value="1" min="1"
                                                    style="width: 100%">
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
