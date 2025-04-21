<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function view()
    {
        // Pastikan semua item di cart memiliki harga yang benar
        foreach (Cart::content() as $item) {
            $product = Product::find($item->id);
            if ($product && $item->price != $product->price) {
                Cart::update($item->rowId, ['price' => $product->price]);
            }
        }
        
        return view('cart.view');
    }

    public function add(Product $product)
    {
        // Pastikan harga yang ditambahkan ke cart sesuai dengan harga produk
        Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'qty' => 1,
            'price' => (float)$product->price,
            'weight' => 0,
            'options' => [
                'image' => $product->image,
            ]
        ]);

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function update(Request $request, $rowId)
    {
        $request->validate([
            'quantity' => 'required|numeric|min:1'
        ]);

        // Pastikan harga tetap konsisten saat update quantity
        $item = Cart::get($rowId);
        if ($item) {
            $product = Product::find($item->id);
            if ($product) {
                Cart::update($rowId, [
                    'qty' => $request->quantity,
                    'price' => (float)$product->price
                ]);
            }
        }

        return redirect()->back()->with('success', 'Cart updated successfully!');
    }

    public function remove($rowId)
    {
        Cart::remove($rowId);
        return redirect()->back()->with('success', 'Product removed from cart successfully!');
    }

    public function clear()
    {
        Cart::destroy();
        return redirect()->back()->with('success', 'Cart cleared successfully!');
    }
}
