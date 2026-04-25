<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'        => 'required|string|max:255',
            'quantity'    => 'required|integer|min:0',
            'price'       => 'required|numeric|min:0',
            'category_id' => 'nullable|exists:categories,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'     => 'Nama produk wajib diisi.',
            'name.string'       => 'Nama produk harus berupa teks.',
            'name.max'          => 'Nama produk tidak boleh lebih dari 255 karakter.',

            'quantity.required' => 'Jumlah (kuantitas) produk wajib diisi.',
            'quantity.integer'  => 'Jumlah produk harus berupa angka bulat (tidak boleh desimal).',
            'quantity.min'      => 'Jumlah produk tidak boleh bernilai negatif.',

            'price.required'    => 'Harga produk wajib diisi.',
            'price.numeric'     => 'Harga produk harus berupa angka yang valid.',
            'price.min'         => 'Harga produk tidak boleh bernilai negatif.',

            'category_id.exists' => 'Kategori yang dipilih tidak valid.',
        ];
    }
}
