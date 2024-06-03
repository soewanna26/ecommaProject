<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $total_product = Product::all()->count();
        $total_order = Order::all()->count();
        $total_user = User::all()->count();

        $order = Order::all();
        $total_revenue = 0;
        foreach($order as $order)
        {
            $total_revenue += $order->price;
        }

        $order_delivered = Order::where('deliver_status', '=' , 'delivered')->get()->count();
        $order_processing = Order::where('deliver_status', '=' , 'processing')->get()->count();
        return view('admin.layout.dashboard',[
            'total_product' => $total_product,
            'total_order' => $total_order,
            'total_user' => $total_user,
            'total_revenue' => $total_revenue,
            'order_delivered' => $order_delivered,
            'order_processing' => $order_processing,
        ]);
    }
}
