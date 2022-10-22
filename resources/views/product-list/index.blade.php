<x-layout>
    <x-slot:title>
        Home
        </x-slot>

        <div class="container">
            @auth
            <div class="row mb-4">
                <div class="col">
                    <a href="/products/create" class="btn btn-primary">New Product</a>
                </div>
            </div>
            @endauth

            <div class="row mb-4">
                <div class="col">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                @php
                                $sort_current_field = request()->query('field', 'created_at');
                                $sort_current_order = request()->query('order', 'desc');

                                $new_order = $sort_current_order === 'asc' ? 'desc' : 'asc';
                                $fa_direction = $sort_current_order === 'asc' ? 'up' : 'down';

                                $fields = [
                                'id',
                                'name',
                                'price',
                                'quantity',
                                'barcode',
                                ];

                                $field_url = [];

                                foreach ($fields as $field) {
                                $field_url[$field] = request()->fullUrlWithQuery(['field' => $field, 'order' =>
                                $new_order]);
                                }

                                @endphp
                                <th>
                                    <a href="{{ $field_url['id'] }}">
                                        ID
                                        @if ($sort_current_field === 'id')
                                        <i class="fa-solid fa-sort-{{ $fa_direction }}"></i>
                                        @endif
                                    </a>
                                </th>
                                <th>
                                    <a href="{{ $field_url['name'] }}">Product Name
                                        @if ($sort_current_field === 'name')
                                        <i class="fa-solid fa-sort-{{ $fa_direction }}"></i>
                                        @endif
                                    </a>
                                </th>
                                <th>
                                    <a href="{{ $field_url['price'] }}">Price (₱)
                                        @if ($sort_current_field === 'price')
                                        <i class="fa-solid fa-sort-{{ $fa_direction }}"></i>
                                        @endif
                                    </a>
                                </th>
                                <th>
                                    <a href="{{ $field_url['quantity'] }}">Quantity
                                        @if ($sort_current_field === 'quantity')
                                        <i class="fa-solid fa-sort-{{ $fa_direction }}"></i>
                                        @endif
                                    </a>
                                </th>
                                <th>
                                    <a href="{{ $field_url['barcode'] }}">Barcode
                                        @if ($sort_current_field === 'barcode')
                                        <i class="fa-solid fa-sort-{{ $fa_direction }}"></i>
                                        @endif
                                    </a>
                                </th>
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
                                        <button type="button" class="btn btn-link @guest disabled @endguest">
                                            <i class="fa-regular fa-pen-to-square"></i> Edit
                                        </button>
                                    </a>
                                    <form action="/products/{{ $product->id }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link @guest disabled @endguest">
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
