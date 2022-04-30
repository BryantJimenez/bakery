<?php

namespace App\Http\Requests\Api\Coupon;

use JoeDixon\Translation\Language;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CouponUpdateRequest extends FormRequest
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
        $discount=($this->type=='1') ? 'required|integer|min:1|max:100' : 'required|string|min:1';
        return [
            'discount' => $discount,
            'limit' => 'required|integer|min:1',
            'type' => 'required|'.Rule::in(['1', '2']),
            'locale' => 'nullable|'.Rule::in($locales)
        ];
    }
}
