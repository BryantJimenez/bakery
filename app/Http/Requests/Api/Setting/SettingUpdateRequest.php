<?php

namespace App\Http\Requests\Api\Setting;

use App\Models\Currency;
use JoeDixon\Translation\Language;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class SettingUpdateRequest extends FormRequest
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
        $currencies=Currency::where('state', '1')->get()->pluck('id');
        return [
            'terms' => 'required|array',
            'terms.*' => 'nullable|string|min:1|max:16770000',
            'privacity' => 'required|array',
            'privacity.*' => 'nullable|string|min:1|max:16770000',
            'stripe_public' => 'nullable|string|min:1|max:191',
            'stripe_secret' => 'nullable|string|min:1|max:191',
            'state' => 'required|'.Rule::in(['0', '1']),
            'currency_id' => 'required|'.Rule::in($currencies),
            'locale' => 'nullable|'.Rule::in($locales)
        ];
    }
}
