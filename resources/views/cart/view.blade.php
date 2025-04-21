@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-2xl font-bold">Shopping Cart</h1>
        <a href="{{ route('user.dashboard') }}" class="text-custom-red hover:text-red-700">Continue Shopping</a>
    </div>

    @if(Cart::count() > 0)
        <div class="bg-custom-gray shadow-lg rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-700">
                <thead class="bg-gray-800">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Product</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Price</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Quantity</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Subtotal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-custom-gray divide-y divide-gray-700">
                    @php
                        $total = 0;
                    @endphp
                    @foreach(Cart::content() as $item)
                        @php
                            $subtotal = (float)$item->price * $item->qty;
                            $total += $subtotal;
                        @endphp
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-full" src="{{ asset('storage/' . $item->options->image) }}" alt="{{ $item->name }}">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-300">{{ $item->name }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-300">${{ number_format((float)$item->price, 2) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <form action="{{ route('cart.update', $item->rowId) }}" method="POST" class="flex items-center">
                                        @csrf
                                        <input type="number" name="quantity" value="{{ $item->qty }}" min="1" class="w-16 text-center bg-gray-700 text-gray-300 border-gray-600 rounded">
                                        <button type="submit" class="ml-2 text-custom-red hover:text-red-700">Update</button>
                                    </form>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-300">${{ number_format($subtotal, 2) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <form action="{{ route('cart.remove', $item->rowId) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-custom-red hover:text-red-700">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-8 bg-custom-gray shadow-lg rounded-lg p-6">
            <div class="flex justify-between items-center">
                <div class="text-lg font-semibold text-gray-300">Total: ${{ number_format($total, 2) }}</div>
                <a href="{{ route('checkout') }}" class="bg-custom-red text-white px-6 py-2 rounded hover:bg-red-700 transition-colors duration-300">
                    Proceed to Checkout
                </a>
            </div>
        </div>
    @else
        <div class="text-center py-12">
            <h2 class="text-2xl font-semibold text-gray-300">Your cart is empty</h2>
            <p class="mt-2 text-gray-400">Start shopping to add items to your cart</p>
        </div>
    @endif
</div>
@endsection 