<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // OrderController.php
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->get();

        return view('orders.index', compact('orders'));
    }
}
