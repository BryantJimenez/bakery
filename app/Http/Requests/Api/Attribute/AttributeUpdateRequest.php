<?php

namespace App\Http\Requests\Api\Attribute;

use JoeDixon\Translation\Language;
use Illuminate\Foundation\Http\FormRequest;
use CodeZero\UniqueTranslation\UniqueTranslationRule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AttributeUpdateRequest extends FormRequest
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
            'name.*' => 'required|string|min:2|max:191|'.UniqueTranslationRule::for('attributes')->ignore($this->attribute->slug, 'slug'),
            'locale' => 'nullable|'.Rule::in($locales)
        ];
    }
}
