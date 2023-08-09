<?php

namespace App\Http\Controllers\Api\V1\WebSite\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Application\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
/**
 * @group WebSiteAdminAuthentication
 *
 * This Api For Admin Authentication in React
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
    public function loginAdmin(LoginRequest $Request)
    {
        if (!Auth::attempt(['email' => $Request->email, 'password' => $Request->password, 'role_id' => 1])) {
            return response(['message' => 'email or password is wrong'], 401);
        }
        $token = auth()->user()->createToken("token")->plainTextToken;
        return response(['token' => $token]);
    }
}
