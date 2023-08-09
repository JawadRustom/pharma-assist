<?php

namespace App\Http\Controllers\Api\V1\Application\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Application\Auth\LoginRequest;
use App\Http\Requests\Api\V1\Application\Auth\RegisterRequest;
use App\Http\Resources\Api\V1\Application\Auth\UserResource;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

/**
 * @group MobileAuthentication
 *
 * This Api For Authentication in flutter
 */
class AuthenticationController extends Controller
{
    /**
     * Login
     *
     * @response scenario="Register Success"{
     * "token":"2|MPvbf6j8OVfoPKuF5bBMUXiE6JrymdQFFHVTHuK1"
     * }
     *
     * @response 422 scenario="Validation errors"{
     *     "message": "The email field is required. (and 1 more error)",
    "errors": {
        "email": [
            "The email field is required."
        ],
        "password": [
            "The password field is required."
        ]
    }
     *
     * }
     *
     *
     * @response 401 scenario="Email or password is wrong or user type not user"{
     * "message": "email or password is wrong"
     * }
     *
     * @response 400 scenario="User send a valid token"{
     * "message": "You are already logged in"
     * }
     */
    public function login(LoginRequest $Request)
    {
        if (!Auth::attempt(['email' => $Request->email, 'password' => $Request->password, 'role_id' => 3])) {
            return response(['message' => 'email or password is wrong'], 401);
        }
        $token = auth()->user()->createToken("token")->plainTextToken;
        return response(['token' => $token]);
    }
    /**
     * Register
     *
     * @response scenario="Register Success"{
     * "token":"11|mrQIWhkKsOorLKuQC0scfJWiKvv7scLmuw2wz71T"
     * }
     *
     * @response 422 scenario="Validation errors"{
     * "message": "The email field is required. (and 7 more errors)",
    "errors": {
        "email": [
            "The email field is required."
        ],
        "password": [
            "The password field is required."
        ],
        "first_name": [
            "The first name field is required."
        ],
        "last_name": [
            "The last name field is required."
        ],
        "phone_number": [
            "The phone number field is required."
        ],
        "birth_date": [
            "The birth date field is required."
        ],
        "specialty": [
            "The specialty field is required."
        ],
        "gender": [
            "The gender field is required."
        ]
    }
     * }
     *
     *
     *
     * @response 400 scenario="User already login"{
     * "message": "You are already logged in"
     * }
     */
    public function register(RegisterRequest $Request)
    {
        $data = User::create([
            'email' => $Request->email,
            'password' => $Request->password,
            'role_id' => 3,
            'first_name' => $Request->first_name,
            'last_name' => $Request->last_name,
            'phone_number' => $Request->phone_number,
        ])->profiles()->create([
            'birth_date' => $Request->birth_date,
            'specialty' => $Request->specialty,
            'gender' => $Request->gender,
        ]);

        Auth::attempt(['email' => $Request->email, 'password' => $Request->password]);
        $token = auth()->user()->createToken("token")->plainTextToken;
        return response(['token' => $token]);
    }
    /**
     * Logout
     *
     *
     * @response 204 scenario="Logout Success"{}
     *
     *
     * @response 401 scenario="User Not Login Yet"{
     *     "message": "Unauthenticated."
     * }
     */
    public function logout()
    {
        auth()->user()->currentAccessToken()->delete();
        return response()->noContent();
    }
}
