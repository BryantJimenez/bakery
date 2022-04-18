<?php

namespace App\Http\Requests\Api\Profile;

use Auth;
use JoeDixon\Translation\Language;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProfileEmailUpdateRequest extends FormRequest
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
      'current_email' => 'required|string|email|max:191',
      'new_email' => 'required|string|email|max:191|unique:users,email,'.Auth::id(),
      'locale' => 'nullable|'.Rule::in($locales)
    ];
  }
}
