<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $cartItems = Cart::with('product')
                           ->where('user_id', null) // For guest users
                           ->get();

            $total = $cartItems->sum(function ($item) {
                return $item->quantity * $item->product->price;
            });

            return response()->json([
                'success' => true,
                'data' => [
                    'items' => $cartItems,
                    'total' => $total,
                    'formatted_total' => 'Rp ' . number_format($total, 0, ',', '.'),
                    'count' => $cartItems->sum('quantity')
                ],
                'message' => 'Cart retrieved successfully'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve cart',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get cart count
     */
    public function count()
    {
        try {
            $count = Cart::where('user_id', null) // For guest users
                        ->sum('quantity');

            return response()->json([
                'success' => true,
                'count' => $count
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to get cart count',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Add product to cart
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'product_id' => 'required|exists:products,id',
                'quantity' => 'required|integer|min:1'
            ]);

            $product = Product::findOrFail($request->product_id);

            // Check stock availability
            if ($product->stock < $request->quantity) {
                return response()->json([
                    'success' => false,
                    'message' => 'Stok tidak mencukupi'
                ], 400);
            }

            // Get cart session ID
            $cartSessionId = Session::getId();

            // Check if product already in cart (for session-based cart)
            $cartItem = Cart::where('product_id', $request->product_id)
                          ->where('user_id', null) // For guest users
                          ->first();

            if ($cartItem) {
                // Update quantity
                $newQuantity = $cartItem->quantity + $request->quantity;

                if ($newQuantity > $product->stock) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Total quantity melebihi stok tersedia'
                    ], 400);
                }

                $cartItem->update(['quantity' => $newQuantity]);
            } else {
                // Create new cart item
                $cartItem = Cart::create([
                    'user_id' => null, // For guest users
                    'product_id' => $request->product_id,
                    'quantity' => $request->quantity
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Produk berhasil ditambahkan ke keranjang',
                'data' => $cartItem->load('product')
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan produk ke keranjang',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $cartItem = Cart::where('id', $id)
                          ->where('user_id', null) // For guest users
                          ->first();

            if (!$cartItem) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cart item not found'
                ], 404);
            }

            $cartItem->delete();

            return response()->json([
                'success' => true,
                'message' => 'Produk berhasil dihapus dari keranjang'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to remove item from cart',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
