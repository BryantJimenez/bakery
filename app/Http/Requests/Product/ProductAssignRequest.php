<?php

namespace App\Http\Requests\Product;

use App\Models\Group\Group;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProductAssignRequest extends FormRequest
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
        $groups=Group::get()->pluck('slug');
        return [
            'group_id' => 'required|array',
            'group_id.*' => 'required|'.Rule::in($groups)
        ];
    }
}
