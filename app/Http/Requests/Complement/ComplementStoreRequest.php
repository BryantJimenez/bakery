<?php

namespace App\Http\Requests\Complement;

use Illuminate\Foundation\Http\FormRequest;

class ComplementStoreRequest extends FormRequest
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
      'name' => 'required|array',
      'name.*' => 'required|string|min:2|max:191',
      'image' => 'required|file|mimetypes:image/*',
      'description' => 'required|array',
      'description.*' => 'nullable|string|min:2|max:5000',
      'price' => 'required|string|min:0'
    ];
  }
}
