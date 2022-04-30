<?php

namespace App\Http\Controllers\Api;

use App\Models\Setting;
use App\Models\Currency;
use JoeDixon\Translation\Language;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Api\Setting\SettingUpdateRequest;
use Illuminate\Http\Request;

class SettingController extends ApiController
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if ($request->has('locale') && !is_null($request->locale)) {
                $language=Language::where('language', $request->locale)->first();
                if (!is_null($language)) {
                    app()->setLocale($language->language);
                }
            }
            return $next($request);
        });
    }
    
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
    *   @OA\Parameter(
    *       name="locale",
    *       in="query",
    *       description="Locale for example ('es','en')",
    *       required=false,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
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
    public function get(Request $request) {
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
    *   @OA\Parameter(
    *       name="locale",
    *       in="query",
    *       description="Locale for example ('es','en')",
    *       required=false,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
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
    public function terms(Request $request) {
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
    *   @OA\Parameter(
    *       name="locale",
    *       in="query",
    *       description="Locale for example ('es','en')",
    *       required=false,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
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
    public function privacity(Request $request) {
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
    *       name="terms[es]",
    *       in="query",
    *       description="Terms and conditions in spanish (The key of the value must be the locale of the language)",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="terms[en]",
    *       in="query",
    *       description="Terms and conditions in english (The key of the value must be the locale of the language)",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="privacity[es]",
    *       in="query",
    *       description="Privacity politics in spanish (The key of the value must be the locale of the language)",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="privacity[en]",
    *       in="query",
    *       description="Privacity politics in english (The key of the value must be the locale of the language)",
    *       required=true,
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
    *       name="state",
    *       in="query",
    *       description="State of shop (0=Closed, 1=Open)",
    *       required=true,
    *       @OA\Schema(
    *           type="string",
    *           enum={"1", "0"}
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
    *   @OA\Parameter(
    *       name="locale",
    *       in="query",
    *       description="Locale for example ('es','en')",
    *       required=false,
    *       @OA\Schema(
    *           type="string"
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
        $force=(request('state')=='1') ? '1' : '0';
        $data=array('terms' => request('terms'), 'privacity' => request('privacity'), 'stripe_public' => request('stripe_public'), 'stripe_secret' => request('stripe_secret'), 'force' => $force, 'state' => request('state'), 'currency_id' => $currency->id);
        $setting->fill($data)->save();
        if ($setting) {
            $setting=Setting::with(['currency'])->first();
            $setting=$this->dataSetting($setting);
            return response()->json(['code' => 200, 'status' => 'success', 'message' => trans('api.settings.update'), 'data' => $setting], 200);
        }
        
        return response()->json(['code' => 500, 'status' => 'error', 'message' => trans('api.errors.500')], 500);
    }
}
