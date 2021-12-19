<?php

namespace App\Http\Controllers\Api;

use App\Models\Currency;
use App\Models\Setting;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Api\Setting\SettingUpdateRequest;
use Illuminate\Http\Request;

class SettingController extends ApiController
{
    /**
    *
    * @OA\Get(
    *   path="/api/v1/settings",
    *   tags={"Settings"},
    *   summary="Get settings",
    *   description="Returns all settings",
    *   operationId="indexSetting",
    *   security={
    *       {"bearerAuth": {}}
    *   },
    *   @OA\Response(
    *       response=200,
    *       description="Show all settings.",
    *       @OA\MediaType(
    *           mediaType="application/json"
    *       )
    *   ),
    *   @OA\Response(
    *       response=401,
    *       description="Not authenticated."
    *   ),
    *   @OA\Response(
    *       response=403,
    *       description="Forbidden."
    *   )
    * )
    */
    public function get() {
        $setting=Setting::with(['currency'])->first();
        $setting=$this->dataSetting($setting);
        return response()->json(['code' => 200, 'status' => 'success', 'data' => $setting], 200);
    }

    /**
    *
    * @OA\Get(
    *   path="/api/v1/settings/terms",
    *   tags={"Settings"},
    *   summary="Get terms and conditions",
    *   description="Returns terms and conditions",
    *   operationId="indexTermsSetting",
    *   security={
    *       {"bearerAuth": {}}
    *   },
    *   @OA\Response(
    *       response=200,
    *       description="Show terms and conditions.",
    *       @OA\MediaType(
    *           mediaType="application/json"
    *       )
    *   ),
    *   @OA\Response(
    *       response=401,
    *       description="Not authenticated."
    *   ),
    *   @OA\Response(
    *       response=403,
    *       description="Forbidden."
    *   )
    * )
    */
    public function terms() {
        $setting=Setting::with(['currency'])->first();
        $terms=(!is_null($setting->terms)) ? $setting->terms : "";
        return response()->json(['code' => 200, 'status' => 'success', 'data' => $terms], 200);
    }

    /**
    *
    * @OA\Get(
    *   path="/api/v1/settings/privacity",
    *   tags={"Settings"},
    *   summary="Get privacity politics",
    *   description="Returns privacity politics",
    *   operationId="indexPrivacitySetting",
    *   security={
    *       {"bearerAuth": {}}
    *   },
    *   @OA\Response(
    *       response=200,
    *       description="Show privacity politics.",
    *       @OA\MediaType(
    *           mediaType="application/json"
    *       )
    *   ),
    *   @OA\Response(
    *       response=401,
    *       description="Not authenticated."
    *   ),
    *   @OA\Response(
    *       response=403,
    *       description="Forbidden."
    *   )
    * )
    */
    public function privacity() {
        $setting=Setting::with(['currency'])->first();
        $privacity=(!is_null($setting->privacity)) ? $setting->privacity : "";
        return response()->json(['code' => 200, 'status' => 'success', 'data' => $privacity], 200);
    }

    /**
    *
    * @OA\Put(
    *   path="/api/v1/settings",
    *   tags={"Settings"},
    *   summary="Update settings",
    *   description="Update settings",
    *   operationId="updateSetting",
    *   security={
    *       {"bearerAuth": {}}
    *   },
    *   @OA\Parameter(
    *       name="terms",
    *       in="query",
    *       description="Terms and conditions",
    *       required=false,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="privacity",
    *       in="query",
    *       description="Privacity politics",
    *       required=false,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="stripe_public",
    *       in="query",
    *       description="Stripe public key",
    *       required=false,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="stripe_secret",
    *       in="query",
    *       description="Stripe secret key",
    *       required=false,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="currency_id",
    *       in="query",
    *       description="Currency ID",
    *       required=true,
    *       @OA\Schema(
    *           type="integer"
    *       )
    *   ),
    *   @OA\Response(
    *       response=200,
    *       description="Update settings.",
    *       @OA\MediaType(
    *           mediaType="application/json"
    *       )
    *   ),
    *   @OA\Response(
    *       response=401,
    *       description="Not authenticated."
    *   ),
    *   @OA\Response(
    *       response=403,
    *       description="Forbidden."
    *   ),
    *   @OA\Response(
    *       response=422,
    *       description="Data not valid."
    *   ),
    *   @OA\Response(
    *       response=500,
    *       description="An error occurred during the process."
    *   )
    * )
    */
    public function update(SettingUpdateRequest $request) {
        $setting=Setting::with(['currency'])->first();
        $currency=Currency::where('id', request('currency_id'))->first();
        $data=array('terms' => request('terms'), 'privacity' => request('privacity'), 'stripe_public' => request('stripe_public'), 'stripe_secret' => request('stripe_secret'), 'currency_id' => $currency->id);
        $setting->fill($data)->save();
        if ($setting) {
            $setting=Setting::with(['currency'])->first();
            $setting=$this->dataSetting($setting);
            return response()->json(['code' => 200, 'status' => 'success', 'message' => 'Los ajustes han sido editados exitosamente.', 'data' => $setting], 200);
        }
        
        return response()->json(['code' => 500, 'status' => 'error', 'message' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'], 500);
    }
}
