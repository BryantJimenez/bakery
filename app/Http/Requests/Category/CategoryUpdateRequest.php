<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;
use CodeZero\UniqueTranslation\UniqueTranslationRule;

class CategoryUpdateRequest extends FormRequest
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
            'name.*' => 'required|string|min:2|max:191|'.UniqueTranslationRule::for('categories')->ignore($this->category->slug, 'slug'),
            
            'image' => 'nullable|file|mimetypes:image/*'
        ];
    }
}
