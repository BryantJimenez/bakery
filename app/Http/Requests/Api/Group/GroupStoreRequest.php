<?php

namespace App\Http\Requests\Api\Group;

use App\Models\Attribute;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class GroupStoreRequest extends FormRequest
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
    $min=$this->min;
    $max=$this->max;
    $attributes=Attribute::where('state', '1')->get()->pluck('id');
    return [
      'name' => 'required|string|min:2|max:191',
      'condition' => 'required|'.Rule::in(['1', '0']),
      'min' => 'required|min:0|max:'.$max,
      'max' => 'required|min:1|max:100',
      'state' => 'required|'.Rule::in(['1', '0']),
      'attribute_id' => 'required|'.Rule::in($attributes)
    ];
  }
}
