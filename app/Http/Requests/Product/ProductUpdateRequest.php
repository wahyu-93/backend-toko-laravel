<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'image' => 'image|mimes:jpg,jpeg,png|max:2000',
            'title' => 'required|unique:products,title,' . $this->route('product')->id,
            'category_id'   => 'required',
            'content'       => 'required',
            'weight'        => 'required',
            'price'         => 'required',
            'discount'      => 'required',
        ];
    }
}
