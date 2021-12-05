<?php

namespace App\Http\Requests\Api\Product;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
        $categories=Category::where('state', '1')->get()->pluck('id');
        return [
            'name' => 'required|string|min:2|max:191',
            'description' => 'nullable|string|min:2|max:5000',
            'price' => 'required|string|min:0',
            'category_id' => 'required|'.Rule::in($categories),
            'state' => 'required|'.Rule::in(['0', '1', '2', '3'])
        ];
    }
}
