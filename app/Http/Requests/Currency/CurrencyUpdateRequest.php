<?php

namespace App\Http\Requests\Currency;

use Illuminate\Foundation\Http\FormRequest;
use CodeZero\UniqueTranslation\UniqueTranslationRule;

class CurrencyUpdateRequest extends FormRequest
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
            'name.*' => 'required|string|min:2|max:191|'.UniqueTranslationRule::for('currencies')->ignore($this->currency->slug, 'slug'),
            'iso' => 'required|string|min:3|max:3',
            'symbol' => 'required|string|min:1|max:2'
        ];
    }
}
