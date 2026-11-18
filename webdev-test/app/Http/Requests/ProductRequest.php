<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Aturan validasi untuk tambah & edit produk.
     */
    public function rules(): array
    {
        // Saat edit, abaikan produk itu sendiri pada pengecekan nama unik.
        $productId = $this->route('product')?->id;

        return [
            'name' => [
                'required',
                'string',
                'min:3',
                'max:255',
                Rule::unique('products', 'name')->ignore($productId),
            ],
            'price' => ['required', 'integer', 'min:1', 'max:999999999'],
            'description' => ['nullable', 'string', 'max:1000'],
        ];
    }

    /**
     * Pesan error dalam Bahasa Indonesia.
     */
    public function messages(): array
    {
        return [
            'required' => ':attribute wajib diisi.',
            'string' => ':attribute harus berupa teks.',
            'integer' => ':attribute harus berupa angka bulat.',
            'name.min' => ':attribute minimal :min karakter.',
            'name.max' => ':attribute maksimal :max karakter.',
            'name.unique' => ':attribute sudah digunakan oleh produk lain.',
            'price.min' => ':attribute minimal Rp 1.',
            'price.max' => ':attribute tidak boleh lebih dari Rp 999.999.999.',
            'description.max' => ':attribute maksimal :max karakter.',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Nama produk',
            'price' => 'Harga',
            'description' => 'Deskripsi',
        ];
    }
}
