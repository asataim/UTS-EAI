@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <h1 class="text-2xl font-bold mb-8">Order Details</h1>

        <div class="bg-custom-gray shadow-lg rounded-lg p-6 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <h2 class="text-lg font-semibold mb-2">Order Information</h2>
                    <p class="text-gray-300"><span class="font-medium">Order ID:</span> #{{ $order->id }}</p>
                    <p class="text-gray-300"><span class="font-medium">Date:</span> {{ $order->created_at->format('d M Y H:i') }}</p>
                    <p class="text-gray-300"><span class="font-medium">Status:</span> 
                        <span class="px-2 py-1 rounded text-sm 
                            {{ $order->status === 'completed' ? 'bg-green-500' : 
                               ($order->status === 'pending' ? 'bg-yellow-500' : 'bg-red-500') }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </p>
                </div>
                <div>
                    <h2 class="text-lg font-semibold mb-2">Customer Information</h2>
                    <p class="text-gray-300"><span class="font-medium">Name:</span> {{ $order->customer_name }}</p>
                    <p class="text-gray-300"><span class="font-medium">Address:</span> {{ $order->address }}</p>
                </div>
            </div>
        </div>

        <div class="bg-custom-gray shadow-lg rounded-lg p-6">
            <h2 class="text-lg font-semibold mb-4">Order Items</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-700">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Product</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Price</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Quantity</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        @foreach($order->items as $item)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $item->product->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">${{ number_format($item->price, 2) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $item->quantity }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">${{ number_format($item->price * $item->quantity, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="px-6 py-4 text-right text-sm font-medium text-gray-300">Total</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-300">${{ number_format($order->total, 2) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <div class="mt-6">
            <a href="{{ route('user.dashboard') }}" class="bg-custom-red text-white px-4 py-2 rounded hover:bg-red-700 transition-colors duration-300">
                Back to Products
            </a>
        </div>
    </div>
</div>
@endsection 