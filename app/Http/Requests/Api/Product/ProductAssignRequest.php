<?php

namespace App\Http\Requests\Api\Product;

use App\Models\Group\Group;
use JoeDixon\Translation\Language;
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
        $locales=Language::all()->pluck('language');
        $groups=Group::where('state', '1')->get()->pluck('id');
        return [
            'group_id' => 'required|array',
            'group_id.*' => 'required|'.Rule::in($groups),
            'locale' => 'nullable|'.Rule::in($locales)
        ];
    }
}
