<?php

namespace App\Http\Requests\Api\Profile;

use JoeDixon\Translation\Language;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
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
        $languages=Language::all()->pluck('id');
        $locales=Language::all()->pluck('language');
        return [
            'name' => 'required|string|min:2|max:191',
            'lastname' => 'required|string|min:2|max:191',
            'address' => 'required|string|min:5|max:191',
            'language_id' => 'required|'.Rule::in($languages),
            'locale' => 'nullable|'.Rule::in($locales)
        ];
    }
}
