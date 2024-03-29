<?php

namespace App\Http\Controllers\Api\Profile;

use App\Models\User;
use JoeDixon\Translation\Language;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Api\Profile\ProfileUpdateRequest;
use App\Http\Requests\Api\Profile\ProfilePasswordUpdateRequest;
use App\Http\Requests\Api\Profile\ProfileEmailUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;

class ProfileController extends ApiController
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
    *   path="/api/v1/profile",
    *   tags={"Profile"},
    *   summary="Get profile",
    *   description="Returns profile data",
    *   operationId="getProfile",
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
    *       description="Get profile.",
    *       @OA\MediaType(
    *           mediaType="application/json"
    *       )
    *   ),
    *   @OA\Response(
    *       response=401,
    *       description="Not authenticated."
    *   )
    * )
    */
    public function get() {
        $user=User::with(['roles', 'language'])->where('id', Auth::user()->id)->first();
        $user=$this->dataUser($user);
        return response()->json(['code' => 200, 'status' => 'success', 'data' => $user], 200);
    }

    /**
    *
    * @OA\Put(
    *   path="/api/v1/profile",
    *   tags={"Profile"},
    *   summary="Update user",
    *   description="Update a profile data",
    *   operationId="updateProfile",
    *   security={
    *       {"bearerAuth": {}}
    *   },
    *   @OA\Parameter(
    *       name="name",
    *       in="query",
    *       description="Name of user",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="lastname",
    *       in="query",
    *       description="Lastname of user",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="address",
    *       in="query",
    *       description="Address of user",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="language_id",
    *       in="query",
    *       description="Language ID of user",
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
    *       description="Update profile user.",
    *       @OA\MediaType(
    *           mediaType="application/json"
    *       )
    *   ),
    *   @OA\Response(
    *       response=401,
    *       description="Not authenticated."
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
    public function update(ProfileUpdateRequest $request) {
    	$user=Auth::user();
    	$data=array('name' => request('name'), 'lastname' => request('lastname'), 'address' => request('address'), 'language_id' => request('language_id'));
    	$user->fill($data)->save();

    	if ($user) {
            $user=User::with(['roles', 'language'])->where('id', $user->id)->first();
            $user=$this->dataUser($user);

            return response()->json(['code' => 200, 'status' => 'success', 'message' => trans('api.profile.update'), 'data' => $user], 200);
        }

        return response()->json(['code' => 500, 'status' => 'error', 'message' => trans('api.errors.500')], 500);
    }

    /**
    *
    * @OA\Post(
    *   path="/api/v1/profile/change/password",
    *   tags={"Profile"},
    *   summary="Update password user",
    *   description="Update password of a user",
    *   operationId="updateProfilePassword",
    *   security={
    *       {"bearerAuth": {}}
    *   },
    *   @OA\Parameter(
    *       name="current_password",
    *       in="query",
    *       description="Current password of user",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="new_password",
    *       in="query",
    *       description="New password of user",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
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
    *       description="Update password.",
    *       @OA\MediaType(
    *           mediaType="application/json"
    *       )
    *   ),
    *   @OA\Response(
    *       response=401,
    *       description="Not authenticated."
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
    public function changePassword(ProfilePasswordUpdateRequest $request) {
    	$user=Auth::user();
    	if (!Hash::check(request('current_password'), $user->password)) {
            return response()->json(['code' => 422, 'status' => 'error', 'message' => trans('api.errors.422.profile.changePassword.password')], 422);
        }

        if (request('current_password')==request('new_password')) {
            return response()->json(['code' => 422, 'status' => 'error', 'message' => trans('api.errors.422.profile.changePassword.equal')], 422);
        }
        $user->fill(['password' => Hash::make(request('new_password'))])->save();

        if ($user) {
            return response()->json(['code' => 200, 'status' => 'success', 'message' => trans('api.profile.changePassword')], 200);
        }

        return response()->json(['code' => 500, 'status' => 'error', 'message' => trans('api.errors.500')], 500);
    }

    /**
    *
    * @OA\Post(
    *   path="/api/v1/profile/change/email",
    *   tags={"Profile"},
    *   summary="Update email user",
    *   description="Update email of a user",
    *   operationId="updateProfileEmail",
    *   security={
    *       {"bearerAuth": {}}
    *   },
    *   @OA\Parameter(
    *       name="current_email",
    *       in="query",
    *       description="Current email of user",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="new_email",
    *       in="query",
    *       description="New email of user",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
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
    *       description="Update email.",
    *       @OA\MediaType(
    *           mediaType="application/json"
    *       )
    *   ),
    *   @OA\Response(
    *       response=401,
    *       description="Not authenticated."
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
    public function changeEmail(ProfileEmailUpdateRequest $request) {
    	$user=Auth::user();
    	if (request('current_email')!=$user->email) {
            return response()->json(['code' => 422, 'status' => 'error', 'message' => trans('api.errors.422.profile.changeEmail.email')], 422);
        }

        if (request('new_email')==$user->email) {
            return response()->json(['code' => 422, 'status' => 'error', 'message' => trans('api.errors.422.profile.changeEmail.equal')], 422);
        }
        $user->fill(['email' => request('new_email')])->save();

        if ($user) {
            return response()->json(['code' => 200, 'status' => 'success', 'message' => trans('api.profile.changeEmail')], 200);
        }
        
        return response()->json(['code' => 500, 'status' => 'error', 'message' => trans('api.errors.500')], 500);
    }
}
