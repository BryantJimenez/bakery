<?php

namespace App\Http\Requests\Api\Profile;

use JoeDixon\Translation\Language;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProfilePasswordUpdateRequest extends FormRequest
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
      'current_password' => 'required|string|min:8',
      'new_password' => 'required|string|min:8',
      'locale' => 'nullable|'.Rule::in($locales)
    ];
  }
}
