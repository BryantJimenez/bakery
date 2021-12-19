<?php

namespace App\Http\Requests\Api\User;

use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
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
        $roles=Role::all()->pluck('name');
        return [
            'name' => 'required|string|min:2|max:191',
            'lastname' => 'required|string|min:2|max:191',
            'phone' => 'required|string|min:5|max:15',
            'address' => 'required|string|min:5|max:191',
            'type' => 'nullable|'.Rule::in($roles)
        ];
    }
}
