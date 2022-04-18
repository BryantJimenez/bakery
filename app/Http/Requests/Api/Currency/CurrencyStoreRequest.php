<?php

namespace App\Http\Requests\Api\Currency;

use JoeDixon\Translation\Language;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CurrencyStoreRequest extends FormRequest
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
      'iso' => 'required|string|min:3|max:3',
      'symbol' => 'required|string|min:1|max:2',
      'locale' => 'nullable|'.Rule::in($locales)
    ];
  }
}
