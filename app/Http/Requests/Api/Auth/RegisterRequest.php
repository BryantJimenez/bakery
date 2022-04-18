<?php

namespace App\Http\Requests\Api\Auth;

use JoeDixon\Translation\Language;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
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
            'name' => 'required|string|min:2|max:191',
            'lastname' => 'required|string|min:2|max:191',
            'email' => 'required|string|email|min:5|max:191|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'locale' => 'nullable|'.Rule::in($locales)
        ];
    }
}
