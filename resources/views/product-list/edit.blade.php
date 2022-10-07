<x-layout>
    <x-slot:title>
        Edit Product - #{{ $product->id }} {{ $product->name }}
        </x-slot>

        <div class="container mt-5">
            <div class="row">
                <div class="col">
                    <h3>Edit Product</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <form action="/products/{{ $product->id }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group @error('name') has-danger @enderror">
                            <label for="name" class="form-label mt-3">Product Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                placeholder="" value="{{ old('name') ?? $product->name }}">
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group @error('price') has-danger @enderror">
                            <label for="name" class="form-label mt-3">Price (₱)</label>
                            <input type="text" class="form-control @error('price') is-invalid @enderror" name="price"
                                placeholder="" value="{{ old('price') ?? $product->price }}">
                            @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group @error('quantity') has-danger @enderror">
                            <label for="name" class="form-label mt-3">Quantity</label>
                            <input type="text" class="form-control @error('quantity') is-invalid @enderror"
                                name="quantity" placeholder="" value="{{ old('quantity') ?? $product->quantity }}">
                            @error('quantity')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group @error('barcode') has-danger @enderror">
                            <label for="name" class="form-label mt-3">Barcode</label>
                            <input type="text" class="form-control @error('barcode') is-invalid @enderror"
                                name="barcode" placeholder="" value="{{ old('barcode') ?? $product->barcode }}">
                            @error('barcode')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <input type="submit" value="Update Product" class="btn btn-primary me-2">
                            <a href="/?page={{ session('current_page') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

</x-layout>
