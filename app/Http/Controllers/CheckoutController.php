<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;

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
        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $paymentIntent = PaymentIntent::create([
                'amount' => Cart::total() * 100, // Convert to cents
                'currency' => 'usd',
                'payment_method' => $request->payment_method,
                'confirm' => true,
                'description' => 'Order from ' . auth()->user()->name,
            ]);

            // Create order
            $order = Order::create([
                'user_id' => auth()->id(),
                'total' => Cart::total(),
                'status' => 'completed',
                'payment_intent_id' => $paymentIntent->id,
                'address' => $request->address,
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

            return redirect()->route('orders.show', $order->id)->with('success', 'Payment successful! Your order has been placed.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
