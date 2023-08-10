<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserAuthController extends Controller
{
    use ApiResponseHelpers;

    public function login(Request $request)
    {
        $validated = Validator::make(
            $request->all(),
            [
                'username' => 'required|string',
                'password' => 'required|min:6',
            ]
        );

        if ($validated->fails()) {
            return $this->respondError($validated->errors());
        }

        $username = $request->username;

        if (!Auth::attempt($request->only(['username', 'password']))) {
            return $this->respondUnAuthenticated('Username & Password does not match with our record.');
        }

        // get user data
        $user = User::where('username', $username)->first();

        if (!$user) {
            return $this->respondNotFound('User is not found');
        }

        $token = $user->createToken("API TOKEN")->plainTextToken;
        $cookie = cookie('jwt', $token, 60 * 24);
        return $this->respondWithSuccess(['user' => $user, 'token' => $token])->withCookie($cookie);
    }

    public function logout()
    {
        $user = auth('sanctum')->user();
        if ($user) {
            $user->tokens()->delete();
            $cookie = Cookie::forget('jwt');

            return $this->respondOk('Logout successfully')->withCookie($cookie);
        }

        return $this->respondNotFound('User not found');
    }
}
