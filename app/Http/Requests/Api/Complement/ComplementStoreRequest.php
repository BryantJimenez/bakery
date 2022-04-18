<?php

namespace App\Http\Requests\Api\Complement;

use JoeDixon\Translation\Language;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
    $locales=Language::all()->pluck('language');
    return [
      'name' => 'required|array',
      'name.*' => 'required|string|min:2|max:191',
      'description' => 'required|array',
      'description.*' => 'nullable|string|min:2|max:5000',
      'price' => 'required|string|min:0',
      'locale' => 'nullable|'.Rule::in($locales)
    ];
  }
}
