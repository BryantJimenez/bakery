<?php

namespace App\Http\Requests\Complement;

use Illuminate\Foundation\Http\FormRequest;

class ComplementUpdateRequest extends FormRequest
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
            'image' => 'nullable|file|mimetypes:image/*',
            'description' => 'nullable|string|min:2|max:5000',
            'price' => 'required|string|min:0'
        ];
    }
}
