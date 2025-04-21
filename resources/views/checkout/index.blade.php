@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <h1 class="text-2xl font-bold mb-8">Checkout</h1>

        @if(session('error'))
            <div class="bg-red-500 text-white p-4 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <h2 class="text-xl font-semibold mb-4">Order Summary</h2>
                <div class="bg-custom-gray shadow-lg rounded-lg p-6">
                    @php
                        $total = 0;
                    @endphp
                    @foreach(Cart::content() as $item)
                        @php
                            $subtotal = (float)$item->price * $item->qty;
                            $total += $subtotal;
                        @endphp
                        <div class="flex justify-between items-center py-2">
                            <div>
                                <h3 class="text-sm font-medium text-gray-300">{{ $item->name }}</h3>
                                <p class="text-sm text-gray-400">Quantity: {{ $item->qty }}</p>
                            </div>
                            <div class="text-sm font-medium text-gray-300">${{ number_format($subtotal, 2) }}</div>
                        </div>
                    @endforeach
                    <div class="border-t border-gray-700 pt-4 mt-4">
                        <div class="flex justify-between items-center">
                            <span class="font-semibold text-gray-300">Total</span>
                            <span class="font-semibold text-gray-300">${{ number_format($total, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <h2 class="text-xl font-semibold mb-4">Order Information</h2>
                <div class="bg-custom-gray shadow-lg rounded-lg p-6">
                    <form action="{{ route('checkout.process') }}" method="POST" id="order-form">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-300">Full Name</label>
                            <input type="text" id="name" name="name" class="mt-1 block w-full bg-gray-700 border-gray-600 rounded-md shadow-sm focus:ring-custom-red focus:border-custom-red text-gray-300" required>
                        </div>

                        <div class="mb-4">
                            <label for="address" class="block text-sm font-medium text-gray-300">Shipping Address</label>
                            <textarea id="address" name="address" rows="3" class="mt-1 block w-full bg-gray-700 border-gray-600 rounded-md shadow-sm focus:ring-custom-red focus:border-custom-red text-gray-300" required></textarea>
                        </div>

                        <button type="submit" class="w-full bg-custom-red text-white px-4 py-2 rounded hover:bg-red-700 transition-colors duration-300">
                            Order Now
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 