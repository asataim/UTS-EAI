@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <h1 class="text-2xl font-bold mb-8">Checkout</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <h2 class="text-xl font-semibold mb-4">Order Summary</h2>
                <div class="bg-white shadow-md rounded-lg p-6">
                    @foreach(Cart::content() as $item)
                        <div class="flex justify-between items-center py-2">
                            <div>
                                <h3 class="text-sm font-medium">{{ $item->model->name }}</h3>
                                <p class="text-sm text-gray-500">Quantity: {{ $item->qty }}</p>
                            </div>
                            <div class="text-sm font-medium">${{ number_format((float)$item->subtotal, 2) }}</div>
                        </div>
                    @endforeach
                    <div class="border-t border-gray-200 pt-4 mt-4">
                        <div class="flex justify-between items-center">
                            <span class="font-semibold">Total</span>
                            <span class="font-semibold">${{ number_format((float)Cart::total(), 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <h2 class="text-xl font-semibold mb-4">Payment Information</h2>
                <div class="bg-white shadow-md rounded-lg p-6">
                    <form action="{{ route('checkout.process') }}" method="POST" id="payment-form">
                        @csrf
                        <div class="mb-4">
                            <label for="card-holder-name" class="block text-sm font-medium text-gray-700">Card Holder Name</label>
                            <input type="text" id="card-holder-name" name="card_holder_name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                        </div>

                        <div class="mb-4">
                            <label for="card-element" class="block text-sm font-medium text-gray-700">Credit or debit card</label>
                            <div id="card-element" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <!-- Stripe Card Element will be inserted here -->
                            </div>
                            <div id="card-errors" class="text-red-500 text-sm mt-2"></div>
                        </div>

                        <div class="mb-4">
                            <label for="address" class="block text-sm font-medium text-gray-700">Shipping Address</label>
                            <textarea id="address" name="address" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required></textarea>
                        </div>

                        <button type="submit" class="w-full bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                            Pay Now
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe('{{ config('services.stripe.key') }}');
    const elements = stripe.elements();
    const cardElement = elements.create('card');
    cardElement.mount('#card-element');

    const form = document.getElementById('payment-form');
    const cardErrors = document.getElementById('card-errors');

    form.addEventListener('submit', async (event) => {
        event.preventDefault();

        const { paymentMethod, error } = await stripe.createPaymentMethod({
            type: 'card',
            card: cardElement,
            billing_details: {
                name: document.getElementById('card-holder-name').value,
            },
        });

        if (error) {
            cardErrors.textContent = error.message;
        } else {
            const hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'payment_method');
            hiddenInput.setAttribute('value', paymentMethod.id);
            form.appendChild(hiddenInput);

            form.submit();
        }
    });
</script>
@endpush
@endsection 