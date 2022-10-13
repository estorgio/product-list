<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        session(['current_page' => request('page')]);

        return view('product-list.index', [
            'products' => Product::latest()->filter(request(['search']))->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product-list.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'barcode' => 'required|unique:products,barcode',
            'product-image' => File::image()
                ->max(1024)
                ->dimensions(
                    Rule::dimensions()
                        ->maxWidth(2000)
                        ->maxHeight(2000)
                )
        ]);

        if ($request->hasFile('product-image')) {
            $formFields['image'] = $request->file('product-image')->store('product-images');
        }

        Product::create($formFields);

        return redirect('/')->with('message', 'New product has been added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('product-list.show', [
            'product' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('product-list.edit', [
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $formFields = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'barcode' => 'exclude_if:barcode,' . $product->barcode . '|required|unique:products,barcode',
            'product-image' => File::image()
                ->max(1024)
                ->dimensions(
                    Rule::dimensions()
                        ->maxWidth(2000)
                        ->maxHeight(2000)
                )
        ]);

        if ($request->hasFile('product-image')) {
            $formFields['image'] = $request->file('product-image')->store('product-images');
        }

        $product->update($formFields);

        return redirect('/')->with('message', 'Product has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect('/')->with('message', 'Product has been deleted.');
    }
}
