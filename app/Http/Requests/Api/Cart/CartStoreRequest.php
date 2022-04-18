<?php

namespace App\Http\Requests\Api\Cart;

use App\Models\Product;
use JoeDixon\Translation\Language;
use App\Models\Group\ComplementGroup;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CartStoreRequest extends FormRequest
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
    $complements_groups=[];
    $products=Product::where('state', '1')->get()->pluck('id');
    $product=Product::with(['groups.complements'])->where('id', $this->product_id)->first();
    if (!is_null($product)) {
      $num=0;
      foreach ($product['groups'] as $group) {
        foreach ($group['complements'] as $complement) {
          $complements_groups[$num]=$complement['pivot']->id;
          $num++;
        }
      }
    }
    $locales=Language::all()->pluck('language');
    return [
      'product_id' => 'required|'.Rule::in($products),
      'complement_group_id' => 'required|array',
      'complement_group_id.*' => 'required|'.Rule::in($complements_groups),
      'locale' => 'nullable|'.Rule::in($locales)
    ];
  }
}
