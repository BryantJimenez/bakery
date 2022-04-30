<?php

namespace App\Http\Requests\Coupon;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CouponStoreRequest extends FormRequest
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
        $discount=($this->type=='1') ? 'required|integer|min:1|max:100' : 'required|string|min:1';
        return [
            'discount' => $discount,
            'limit' => 'required|integer|min:1',
            'type' => 'required|'.Rule::in(['1', '2'])
        ];
    }
}
