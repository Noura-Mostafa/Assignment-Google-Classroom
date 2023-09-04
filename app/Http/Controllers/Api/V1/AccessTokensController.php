<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccessTokensController extends Controller
{


    public function index()
    {
        if (!Auth::guard('sanctum')->user()->tokenCan('classrooms.read')) {
               abort(403);
        };

        return Auth::guard('sanctum')->user()->tokens;
    }


    public function store(Request $request)
    {

        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'device_name' => ['sometimes', 'required'],
            'abilities' => ['array']
        ]);

        $user = User::whereEmail($request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {

            $name = $request->post('device_name', $request->userAgent());

            $abilities = $request->post('abilities', ['*']);

            $token = $user->createToken($name, $abilities, now()->addDays(90));

            return response()->json([
                'token' => $token->plainTextToken,
                'user' => $user,
            ], 201);
        }

        return response()->json([
            'message' => __('Invalid credentials'),
        ], 401);
    }

    public function destroy($id = null)
    {
        if (!Auth::guard('sanctum')->user()->tokenCan('classrooms.delete')) {
            abort(403);
        };

        $user = Auth::guard('sanctum')->user();

        if ($id) {
            //revoke (logout from current device)
            if ($id == 'current') {
                $user->currentAccessToken()->delete();
            } else {
                $user->tokens()->findOrFail($id)->delete();
            }
        } else {
            //logout from all devices
            $user->tokens()->delete();
        }
    }
}
