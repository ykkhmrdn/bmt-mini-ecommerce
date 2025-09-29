<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Process checkout
     */
    public function store(Request $request)
    {
        try {
            // Get cart items for guest users
            $cartItems = Cart::with('product')
                           ->where('user_id', null)
                           ->get();

            if ($cartItems->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Keranjang kosong'
                ], 400);
            }

            // Validate stock availability
            foreach ($cartItems as $item) {
                if ($item->product->stock < $item->quantity) {
                    return response()->json([
                        'success' => false,
                        'message' => "Stok tidak mencukupi untuk produk: {$item->product->name}"
                    ], 400);
                }
            }

            // Calculate total
            $total = $cartItems->sum(function ($item) {
                return $item->quantity * $item->product->price;
            });

            DB::beginTransaction();

            try {
                // Create transaction
                $transaction = Transaction::create([
                    'user_id' => null, // For guest users
                    'total' => $total,
                    'status' => 'completed'
                ]);

                // Create transaction items and update stock
                foreach ($cartItems as $item) {
                    TransactionItem::create([
                        'transaction_id' => $transaction->id,
                        'product_id' => $item->product_id,
                        'quantity' => $item->quantity,
                        'price' => $item->product->price
                    ]);

                    // Reduce product stock
                    $item->product->decrement('stock', $item->quantity);
                }

                // Clear cart
                Cart::where('user_id', null)->delete();

                DB::commit();

                return response()->json([
                    'success' => true,
                    'message' => 'Checkout berhasil! Pesanan Anda sedang diproses.',
                    'data' => [
                        'transaction_id' => $transaction->id,
                        'total' => $transaction->formatted_total,
                        'items_count' => $cartItems->count()
                    ]
                ], 200);

            } catch (\Exception $e) {
                DB::rollback();
                throw $e;
            }

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memproses checkout',
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
        //
    }
}
