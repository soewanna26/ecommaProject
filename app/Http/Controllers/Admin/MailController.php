<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\EcommaProject;
use Mail;
use App\Models\Order;
use Illuminate\Http\Request;

class MailController extends Controller
{
    public function index($id)
    {
        $order = Order::find($id);
        $mailData = [
            'name' => $order->name,
            'price' => $order->price,
            'productTitle' => $order->product_title,
            'quantity' => $order->quantity,
        ];

        Mail::to($order->user->email)->send(new EcommaProject($mailData));

        return redirect()->back()->with('success', 'Mail Send Successfully');
    }
}
