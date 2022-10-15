<x-layout>
    <x-slot:title>
        Product Info - {{ $product->name }}
        </x-slot>

        <div class="container mt-5">
            <div class="row">
                <div class="col">
                    <h3>Product Information</h3>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-7">
                    <div class="row justify-content-start">
                        <div class="col-4">
                            <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/200x200' }}"
                                alt="image" class="img-thumbnail">
                        </div>
                        <div class="col">
                            <div class="row mb-2">
                                <div class="col"><strong>Product ID:</strong></div>
                                <div class="col">{{ $product->id }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col"><strong>Product Name:</strong></div>
                                <div class="col">{{ $product->name }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col"><strong>Price:</strong></div>
                                <div class="col">₱ {{ $product->price }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col"><strong>Quantity:</strong></div>
                                <div class="col">{{ $product->quantity }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col"><strong>Barcode:</strong></div>
                                <div class="col">{{ $product->barcode }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col"><strong>Date added:</strong></div>
                                <div class="col">{{ $product->created_at }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col"><strong>Created by:</strong></div>
                                <div class="col">{{ $product->user->username }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col">
                    @auth
                    <a href="/products/{{ $product->id }}/edit" class="btn btn-primary me-2">Edit Product</a>
                    @endauth
                    <a href="/?page={{ session('current_page') }}" class="btn btn-secondary">Back</a>
                </div>
            </div>
        </div>
</x-layout>
