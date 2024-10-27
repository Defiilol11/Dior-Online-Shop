<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Address;
use App\Models\Order;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function showCheckout()
    {
        $userId = Auth::id();
        $branches = Branch::all();
        $cart = Cart::where('user_id', $userId)->where('status', 'active')->first();

        if (!$cart) {
            return redirect()->back()->with('error', 'No tienes productos en tu carrito.');
        }

        return view('checkout', compact('branches', 'cart'));
    }

    public function storeCheckout(Request $request)
    {
        $userId = Auth::id();

        $request->validate([
            'address' => 'required|string|max:500',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'branch_id' => 'required|exists:branches,id',
            'payment_method' => 'required|string',
            'payment_data' => 'nullable|array',
        ]);

        $cart = Cart::where('user_id', $userId)->where('status', 'active')->first();

        if (!$cart) {
            return response()->json(['error' => 'No tienes un carrito activo.'], 400);
        }

        $address = Address::create([
            'user_id' => $userId,
            'address_line' => $request->address,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude
        ]);

        $order = Order::create([
            'user_id' => $userId,
            'cart_id' => $cart->id,
            'shipping_address_id' => $address->id,
            'branch_id' => $request->branch_id,
            'status' => 'pending',
            'payment_method' => $request->payment_method,
            'payment_data' => json_encode($request->payment_data)
        ]);

        $cart->status = 'processing';
        $cart->save();

        return response()->json(['message' => 'Orden confirmada'], 200);
    }
}
