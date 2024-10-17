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
            // Redirigir a la página de inicio de sesión con un mensaje de alerta en la sesión
            return redirect()->route('login')->with('alert', 'No ha iniciado sesión, no puede generar un carrito');
        }
        // Obtener el usuario autenticado
        $user = Auth::user();

        // Verificar si el producto existe
        $product = Product::findOrFail($productId);

        // Obtener el carrito activo del usuario o crear uno nuevo
        $cart = Cart::firstOrCreate(
            ['user_id' => $user->id, 'status' => 'active']
        );

        // Verificar si el producto ya está en el carrito
        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            // Si ya está en el carrito, aumentar la cantidad
            $cartItem->quantity += $request->input('quantity');
            $cartItem->save();
        } else {
            // Si no está en el carrito, agregarlo
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

        // Buscar el carrito del usuario que esté en estado 'active'
        $cart = Cart::where('user_id', $userId)->where('status', 'active')->first();

        // Si no se encuentra el carrito, enviar un indicador
        if (!$cart) {
            return view('index')->with('noCart', true);
        } else {
            // Si el carrito existe, cargar los items del carrito
            $cartItems = $cart->cartItems()->with('product')->get();

            // Retornar la vista con los items del carrito
            return view('cart.show', compact('cartItems'));
        }
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
