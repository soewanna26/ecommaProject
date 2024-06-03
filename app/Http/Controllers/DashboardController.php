<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Comment;
use App\Models\Order;
use App\Models\Product;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $products = Product::with('category')->orderBy('created_at', 'DESC')->paginate(6);
        $comments = Comment::orderBy('id', 'DESC')->get();
        $replies  = Reply::all();
        $cart_count = 0;
        if (Auth::check()) {
            $id = Auth::user()->id;
            $cart_count = Cart::where('user_id', '=', $id)->count();
        }

        if (Auth::check()) {
            return view('account.dashboard', [
                'products' => $products,
                'comments' => $comments,
                'replies' => $replies,
                'cart_count' => $cart_count
            ]);
        }
        return view('layout.app', [
            'products' => $products,
            'comments' => $comments,
            'replies' => $replies,
            'cart_count' => $cart_count
        ]);
    }

    public function product_search(Request $request)
    {
        $search_product = $request->search;
        $products = Product::where('title', 'LIKE', '%' . $search_product . '%')->orWhereHas('category', function ($query) use ($search_product) {
            $query->where('category_name', 'LIKE', '%' . $search_product . '%');
        })->paginate(6);
        $comments = Comment::orderBy('id', 'DESC')->get();
        $replies  = Reply::all();
        if (Auth::check()) {
            return view('account.dashboard', [
                'products' => $products,
                'comments' => $comments,
                'replies' => $replies
            ]);
        }
        return view('layout.app', [
            'products' => $products,
            'comments' => $comments,
            'replies' => $replies
        ]);
    }

    public function product_detail($id)
    {
        $product = Product::findOrFail($id);
        $cart_count = 0;
        if (Auth::check()) {
            $id = Auth::user()->id;
            $cart_count = Cart::where('user_id', '=', $id)->count();
        }
        return view('layout.product_detail', [
            'product' => $product,
            'cart_count'=>$cart_count
        ]);
    }

    public function add_cart($id, Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $userId = $user->id;
            $product = Product::findOrFail($id);
            $product_exist_id = Cart::where('product_id', '=', $id)->where('user_id', '=', $userId)->get('id')->first();

            if ($product_exist_id) {
                $cart = Cart::find($product_exist_id)->first();
                $quantity = $cart->quantity;
                $cart->quantity = $quantity + $request->quantity;
                if ($product->discount_price != null) {
                    $cart->price = $product->discount_price * $request->quantity;
                } else {
                    $cart->price = $product->price * $request->quantity;
                }
                $cart->save();
                return redirect()->back()->with('success', 'Cart added successfully');
            } else {
                $cart = new Cart();
                $cart->product_id = $product->id;
                $cart->user_id = $user->id;
                $cart->name = $user->name;
                $cart->email = $user->email;
                $cart->phone = $user->phone;
                $cart->address = $user->address;
                $cart->product_title = $product->title;
                if ($product->discount_price != null) {
                    $cart->price = $product->discount_price * $request->quantity;
                } else {
                    $cart->price = $product->price * $request->quantity;
                }
                $cart->image = $product->image;
                $cart->quantity = $request->quantity;
                $cart->save();
                Alert::success('Product added successfully', 'We Have Added Product to the Cart');
                return redirect()->back();
            }
        } else {
            return redirect()->route('account.login');
        }
    }

    public function show_cart()
    {
        if (Auth::check()) {
            $id = Auth::user()->id;
            $cart = Cart::where('user_id', '=', $id);
            $cart_count = $cart->count();
            $cart = $cart->get();
            return view('layout.show_cart', [
                'cart' => $cart,
                'cart_count' => $cart_count
            ]);
        } else {
            return redirect()->route('account.login');
        }
    }

    public function remove_cart($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();
        Alert::success('Product Removed', 'You have Remove a Product from the Cart');
        return redirect()->back()->with('success', 'Cart removed successfully');
    }

    public function cart_order()
    {
        $user = Auth::user()->id;
        $data = Cart::where('user_id', '=', $user)->get();

        foreach ($data as $data) {
            $order = new Order();
            $order->product_id = $data->product_id;
            $order->user_id = $user;
            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address = $data->address;
            $order->product_title = $data->product_title;
            $order->quantity = $data->quantity;
            $order->price = $data->price;
            $order->image = $data->image;
            $order->payment_status = "cash on delivery";
            $order->deliver_status = "processing";
            $order->save();

            $cart_id = $data->id;
            $cart = Cart::findOrFail($cart_id);
            $cart->delete();
        }
        return redirect()->back()->with('success', 'We have Received your Order.We will connect with you soon');
    }

    public function customer_order()
    {
        if (Auth::check()) {
            $id = Auth::user()->id;
            $order = Order::where('user_id', '=', $id)->get();
            $cart = Cart::where('user_id', '=', $id);
            $cart_count = $cart->count();
            $cart = $cart->get();
            return view('layout.customer_order', [
                'order' => $order,
                'cart_count' => $cart_count
            ]);
        } else {
            return redirect()->route('account.login');
        }
    }

    public function cancel_order($id)
    {
        $order = Order::findOrFail($id);
        $order->deliver_status = 'You canceled the order';
        $order->save();
        return redirect()->back()->with('success', 'Order removed successfully');
    }

    public function add_comment(Request $request)
    {
        if (Auth::check()) {
            $comment = new Comment();
            $comment->name = Auth::user()->name;
            $comment->user_id = Auth::user()->id;
            $comment->comment = $request->comment;
            $comment->save();
            return redirect()->back();
        } else {
            return redirect()->route('account.login');
        }
    }
    public function add_reply(Request $request)
    {
        if (Auth::check()) {
            $reply = new Reply();
            $reply->name = Auth::user()->name;
            $reply->user_id = Auth::user()->id;
            $reply->comment_id = $request->commentId;
            $reply->reply = $request->reply;
            $reply->save();
            return redirect()->back();
        } else {
            return redirect()->route('account.login');
        }
    }
}
