<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use PDF;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['product', 'user'])->orderBy('created_at', 'DESC')->paginate(9);
        return view('admin.order.list', [
            'orders' => $orders
        ]);
    }

    public function delivered($id)
    {
        $order = Order::findOrFail($id);
        $order->deliver_status = 'delivered';
        $order->update();

        return redirect()->back()->with('success', 'Order is delivered');
    }

    public function print_pdf($id)
    {
        $order = Order::findOrFail($id);
        $pdf = PDF::loadView('admin.order.pdf', compact('order'));

        return $pdf->download('order_details.pdf');
    }

    public function searchOrder(Request $request)
    {
        $searchText = $request->search;
        $orders = Order::where('name', 'LIKE', '%' . $searchText . '%')->orWhere('phone', 'LIKE', '%' . $searchText . '%')->orWhere('product_title', 'LIKE', '%' . $searchText . '%')->paginate(9);

        return view('admin.order.list', [
            'orders' => $orders,
        ]);
    }
}
