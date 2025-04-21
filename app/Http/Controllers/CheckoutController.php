<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        if (Cart::count() === 0) {
            return redirect()->route('cart.view')->with('error', 'Your cart is empty!');
        }

        return view('checkout.index');
    }

    public function process(Request $request)
    {
        try {
            // Validate required fields
            $request->validate([
                'name' => 'required',
                'address' => 'required'
            ]);

            // Calculate total amount
            $total = 0;
            foreach (Cart::content() as $item) {
                $total += (float)$item->price * $item->qty;
            }

            // Create order
            $order = Order::create([
                'user_id' => auth()->id(),
                'total' => $total,
                'status' => 'pending',
                'address' => $request->address,
                'customer_name' => $request->name
            ]);

            // Create order items
            foreach (Cart::content() as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->id,
                    'quantity' => $item->qty,
                    'price' => $item->price,
                ]);
            }

            // Clear cart
            Cart::destroy();

            return redirect()->route('orders.show', $order->id)->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
