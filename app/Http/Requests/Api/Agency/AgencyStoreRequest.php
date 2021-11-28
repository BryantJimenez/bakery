<?php

namespace App\Http\Requests\Api\Agency;

use Illuminate\Foundation\Http\FormRequest;

class AgencyStoreRequest extends FormRequest
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
      'name' => 'required|string|min:2|max:191',
      'route' => 'required|string|min:2|max:191',
      'price' => 'required|string|min:0',
      'description' => 'nullable|string|min:2|max:191'
    ];
  }
}
