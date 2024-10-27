<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request, $productId)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('alert', 'No ha iniciado sesión, no puede generar un carrito');
        }

        $user = Auth::user();
        $product = Product::findOrFail($productId);
        
        $cart = Cart::firstOrCreate(['user_id' => $user->id, 'status' => 'active']);
        
        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $request->input('quantity');
            $cartItem->save();
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'quantity' => $request->input('quantity')
            ]);
        }

        return redirect()->back()->with('success', 'Producto agregado al carrito');
    }

    public function show()
    {
        $userId = Auth::id();
        $cart = Cart::where('user_id', $userId)->where('status', 'active')->first();

        if (!$cart) {
            return view('index')->with('noCart', true);
        }

        $cartItems = $cart->cartItems()->with('product')->get();
        return view('cart.show', compact('cartItems'));
    }

    public function removeItem($itemId)
    {
        $cartItem = CartItem::findOrFail($itemId);
        $cartItem->delete();

        return response()->json(['success' => true]);
    }

    public function updateQuantity(Request $request, $itemId)
    {
        $cartItem = CartItem::findOrFail($itemId);
        $cartItem->quantity = $request->input('quantity');
        $cartItem->save();

        return response()->json(['success' => true]);
    }
}
