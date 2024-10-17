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

        // Obtener sucursales de la base de datos
        $branches = Branch::all();

        // Verificar si el usuario tiene un carrito activo
        $cart = Cart::where('user_id', $userId)->where('status', 'active')->first();

        if (!$cart) {
            return redirect()->back()->with('error', 'No tienes productos en tu carrito.');
        }

        return view('checkout', compact('branches', 'cart'));
    }

    public function processCheckout(Request $request)
    {
        $userId = Auth::id();

        // Validar los datos del formulario
        $request->validate([
            'address_line' => 'required|string|max:500',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'branch_id' => 'required|exists:branches,id'
        ]);

        // Crear dirección
        $address = Address::create([
            'user_id' => $userId,
            'address_line' => $request->address_line,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude
        ]);

        // Crear la orden
        $order = Order::create([
            'user_id' => $userId,
            'cart_id' => $request->cart_id,
            'shipping_address_id' => $address->id,
            'status' => 'pending',  // Estado inicial de la orden
            'payment_method' => $request->payment_method
        ]);

        // Cambiar el estado del carrito a "processing"
        $cart = Cart::find($request->cart_id);
        $cart->status = 'processing';
        $cart->save();

        return redirect()->route('order.success');
    }
    public function storeCheckout(Request $request)
    {
        $userId = Auth::id();

        // Validar los datos
        $request->validate([
            'address' => 'required|string|max:500',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'branch_id' => 'required|exists:branches,id',
        ]);

        // Crear la dirección
        $address = Address::create([
            'user_id' => $userId,
            'address_line' => $request->address,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        // Obtener el carrito activo del usuario
        $cart = Cart::where('user_id', $userId)->where('status', 'active')->firstOrFail();

        // Crear la orden
        Order::create([
            'user_id' => $userId,
            'cart_id' => $cart->id,
            'shipping_address_id' => $address->id,
            'status' => 'processing',
            'payment_method' => 'pending',
        ]);

        // Actualizar el carrito a 'processing'
        $cart->update(['status' => 'processing']);

        return response()->json(['message' => 'Orden creada con éxito.']);
    }
}
