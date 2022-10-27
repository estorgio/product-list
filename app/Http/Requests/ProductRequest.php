<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(Request $request)
    {
        $product = $request->route('product');
        return [
            'name' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'barcode' =>  is_null($product)
                ? 'required|unique:products,barcode'
                : 'exclude_if:barcode,' . $product->barcode . '|required|unique:products,barcode',
            'image' => File::image()
                ->max(1024)
                ->dimensions(
                    Rule::dimensions()
                        ->maxWidth(2000)
                        ->maxHeight(2000)
                )
        ];
    }

    public function attributes()
    {
        return [
            'image' => 'product image',
        ];
    }
}
