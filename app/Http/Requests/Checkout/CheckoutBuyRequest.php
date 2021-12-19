<?php

namespace App\Http\Requests\Checkout;

use App\Models\Agency;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CheckoutBuyRequest extends FormRequest
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
        $agencies=Agency::where('state', '1')->get()->pluck('slug');
        $shipping=($this->shipping=='3') ? true : false;
        return [
            'phone' => 'required|string|min:5|max:15',
            'shipping' => 'required|'.Rule::in(['1', '2', '3']),
            'agency_id' => Rule::requiredIf($shipping).'|'.Rule::in($agencies),
            'address' => Rule::requiredIf($shipping).'|string|min:5|max:191',
            'payment' => 'required|'.Rule::in(['1']),
            'stripeToken' => 'required'
        ];
    }
}
