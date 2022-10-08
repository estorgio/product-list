<x-layout>
    <x-slot:title>
        Home
        </x-slot>

        <div class="container">
            <div class="row mb-4">
                <div class="col">
                    <a href="/products/create" class="btn btn-primary">New Product</a>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Product Name</th>
                                <th>Price (₱)</th>
                                <th>Quantity</th>
                                <th>Barcode</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                            <tr>
                                <td>{{$product->id}}</td>
                                <td>
                                    <a href="/products/{{ $product->id }}">
                                        {{ $product->name }}
                                    </a>
                                </td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>{{ $product->barcode }}</td>
                                <td>
                                    <a href="/products/{{ $product->id }}/edit" class="text-decoration-none">
                                        <button type="button" class="btn btn-link">
                                            <i class="fa-regular fa-pen-to-square"></i> Edit
                                        </button>
                                    </a>
                                    <form action="/products/{{ $product->id }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link">
                                            <i class="fa-solid fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">No products listed.</td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div>
                        {{ $products->onEachSide(1)->links() }}
                    </div>
                </div>
            </div>

        </div>
</x-layout>
