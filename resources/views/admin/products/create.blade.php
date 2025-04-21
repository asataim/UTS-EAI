@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-gray-800 rounded-lg shadow-lg p-6">
        <h1 class="text-2xl font-bold text-white mb-6">Add New Product</h1>

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-300">Product Name</label>
                    <input type="text" name="name" id="name" required
                           class="mt-1 block w-full rounded-md bg-gray-700 border-gray-600 text-white focus:border-red-500 focus:ring-red-500">
                </div>

                <div>
                    <label for="price" class="block text-sm font-medium text-gray-300">Price</label>
                    <input type="number" name="price" id="price" required min="0" step="0.01"
                           class="mt-1 block w-full rounded-md bg-gray-700 border-gray-600 text-white focus:border-red-500 focus:ring-red-500">
                </div>

                <div>
                    <label for="stock" class="block text-sm font-medium text-gray-300">Stock</label>
                    <input type="number" name="stock" id="stock" required min="0"
                           class="mt-1 block w-full rounded-md bg-gray-700 border-gray-600 text-white focus:border-red-500 focus:ring-red-500">
                </div>

                <div>
                    <label for="image" class="block text-sm font-medium text-gray-300">Product Image</label>
                    <input type="file" name="image" id="image" accept="image/*"
                           class="mt-1 block w-full text-gray-300">
                </div>

                <div class="md:col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-300">Description</label>
                    <textarea name="description" id="description" rows="4"
                              class="mt-1 block w-full rounded-md bg-gray-700 border-gray-600 text-white focus:border-red-500 focus:ring-red-500"></textarea>
                </div>
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('admin.dashboard') }}"
                   class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
                    Cancel
                </a>
                <button type="submit"
                        class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                    Add Product
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 