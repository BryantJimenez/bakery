<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Api\Profile\ProfileUpdateRequest;
use App\Http\Requests\Api\Profile\ProfilePasswordUpdateRequest;
use App\Http\Requests\Api\Profile\ProfileEmailUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;

class ProfileController extends ApiController
{
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
        $user=User::with(['roles'])->where('id', Auth::user()->id)->first();
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
    	$data=array('name' => request('name'), 'lastname' => request('lastname'));
    	$user->fill($data)->save();

    	if ($user) {
            $user=User::with(['roles'])->where('id', $user->id)->first();
            $user=$this->dataUser($user);

            return response()->json(['code' => 200, 'status' => 'success', 'message' => 'Perfil de usuario actualizado exitosamente.', 'data' => $user], 200);
        }

        return response()->json(['code' => 500, 'status' => 'error', 'message' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'], 500);
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
            return response()->json(['code' => 422, 'status' => 'error', 'message' => 'La contraseña actual es incorrecta.'], 422);
        }

        if (request('current_password')==request('new_password')) {
            return response()->json(['code' => 422, 'status' => 'error', 'message' => 'La nueva contraseña no puede ser la misma que la actual.'], 422);
        }
        $user->fill(['password' => Hash::make(request('new_password'))])->save();

        if ($user) {
            return response()->json(['code' => 200, 'status' => 'success', 'message' => 'La contraseña fue editada exitosamente.'], 200);
        }

        return response()->json(['code' => 500, 'status' => 'error', 'message' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'], 500);
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
            return response()->json(['code' => 422, 'status' => 'error', 'message' => 'El correo electrónico actual es incorrecto.'], 422);
        }

        if (request('new_email')==$user->email) {
            return response()->json(['code' => 422, 'status' => 'error', 'message' => 'El nuevo correo electrónico no puede ser el mismo que el actual.'], 422);
        }
        $user->fill(['email' => request('new_email')])->save();

        if ($user) {
            return response()->json(['code' => 200, 'status' => 'success', 'message' => 'El correo electrónico fue editado exitosamente.'], 200);
        }
        
        return response()->json(['code' => 500, 'status' => 'error', 'message' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'], 500);
    }
}
