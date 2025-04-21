@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-gray-800 rounded-lg shadow-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-white">Order Details #{{ $order->id }}</h1>
            <div class="flex items-center space-x-4">
                <span class="px-3 py-1 rounded-full text-sm font-medium
                    @if($order->status === 'completed') bg-green-500 text-white
                    @elseif($order->status === 'pending') bg-yellow-500 text-white
                    @elseif($order->status === 'processing') bg-blue-500 text-white
                    @else bg-red-500 text-white @endif">
                    {{ ucfirst($order->status) }}
                </span>
                <form action="{{ route('admin.orders.update', $order) }}" method="POST" class="flex items-center">
                    @csrf
                    @method('PUT')
                    <select name="status" class="bg-gray-700 text-white rounded px-3 py-1">
                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    <button type="submit" class="ml-2 bg-red-500 text-white px-4 py-1 rounded hover:bg-red-600">
                        Update Status
                    </button>
                </form>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="bg-gray-700 p-4 rounded-lg">
                <h2 class="text-xl font-semibold text-white mb-4">Customer Information</h2>
                <div class="space-y-2 text-gray-300">
                    <p><span class="font-medium">Name:</span> {{ $order->user->name }}</p>
                    <p><span class="font-medium">Email:</span> {{ $order->user->email }}</p>
                    <p><span class="font-medium">Phone:</span> {{ $order->phone ?? 'N/A' }}</p>
                    <p><span class="font-medium">Address:</span> {{ $order->address ?? 'N/A' }}</p>
                </div>
            </div>

            <div class="bg-gray-700 p-4 rounded-lg">
                <h2 class="text-xl font-semibold text-white mb-4">Order Information</h2>
                <div class="space-y-2 text-gray-300">
                    <p><span class="font-medium">Order Date:</span> {{ $order->created_at->format('F j, Y H:i') }}</p>
                    <p><span class="font-medium">Payment Method:</span> {{ $order->payment_method ?? 'N/A' }}</p>
                    <p><span class="font-medium">Payment Status:</span> {{ $order->payment_status ?? 'N/A' }}</p>
                    <p><span class="font-medium">Total Amount:</span> Rp {{ number_format($order->total, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>

        <div class="bg-gray-700 p-4 rounded-lg">
            <h2 class="text-xl font-semibold text-white mb-4">Order Items</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-600">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Product</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Price</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Quantity</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-600">
                        @foreach($order->items as $item)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-300">
                                {{ $item->product->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-300">
                                Rp {{ number_format($item->price, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-300">
                                {{ $item->quantity }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-300">
                                Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-6 flex justify-end">
            <a href="{{ route('admin.orders.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
                Back to Orders
            </a>
        </div>
    </div>
</div>
@endsection 