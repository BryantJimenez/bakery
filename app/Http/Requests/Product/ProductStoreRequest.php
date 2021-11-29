<?php

namespace App\Http\Requests\Product;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProductStoreRequest extends FormRequest
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
    $categories=Category::where('state', '1')->get()->pluck('slug');
    return [
      'name' => 'required|string|min:2|max:191',
      'image' => 'required|file|mimetypes:image/*',
      'description' => 'nullable|string|min:2|max:5000',
      'price' => 'required|string|min:0',
      'category_id' => 'required|'.Rule::in($categories)
    ];
  }
}
