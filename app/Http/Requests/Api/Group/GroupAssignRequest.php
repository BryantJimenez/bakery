<?php

namespace App\Http\Requests\Api\Group;

use App\Models\Complement;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class GroupAssignRequest extends FormRequest
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
        $complements=Complement::where('state', '1')->get()->pluck('id');
        return [
            'complement_id' => 'required|array',
            'complement_id.*' => 'required|'.Rule::in($complements),
            'price' => 'required|array',
            'price.*' => 'required|string|min:0',
            'state' => 'required|array',
            'state.*' => 'required|'.Rule::in(['0', '1', '2', '3'])
        ];
    }
}
