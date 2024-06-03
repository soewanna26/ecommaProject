<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductPageController extends Controller
{
    public function product_page()
    {
        $products = Product::with('category')->orderBy('created_at', 'DESC')->paginate(6);
        $cart_count = 0;
        if (Auth::check()) {
            $id = Auth::user()->id;
            $cart_count = Cart::where('user_id', '=', $id)->count();
        }
        return view('layout.product.product_page',[
            'products' => $products,
            'cart_count' => $cart_count
        ]);
    }

    public function search_product(Request $request)
    {
        $search_product = $request->search;
        $products = Product::where('title', 'LIKE', '%' . $search_product . '%')->orWhereHas('category', function ($query) use ($search_product) {
            $query->where('category_name', 'LIKE', '%' . $search_product . '%');
        })->paginate(6);
        return view('layout.product.product_page',[
            'products' => $products
        ]);
    }
}
