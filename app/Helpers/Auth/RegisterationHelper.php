<?php

namespace App\Helpers\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use NunoMaduro\Collision\Provider;

class RegisterationHelper
{
    public static function login(string $provider, string $email, string $password): string
    {
        $user = User::where('email', $email)->first();
        if (!$user) {
            throw ValidationException::withMessages([
                'email' => [__('auth.failed')],
            ]);
        } else if ($user->provider !== $provider) {
            throw ValidationException::withMessages([
                'email' => [__('validation.provider') . $user->provider],
            ]);
        } else if (!Hash::check($password, $user->password) && $provider == 'local') {
            throw ValidationException::withMessages([
                'email' => [__('auth.failed')],
            ]);
        }

        return $user->createToken('token')->plainTextToken;
    }

    public static function register(string $provider, array $attributes): string
    {
        $user = User::where('email', $attributes['email'])->first();
        if ($user) {
            throw ValidationException::withMessages([
                'email' => [__('auth.exists')],
            ]);
        }
        $password = $attributes['password'];
        if ($provider != 'local') {
            $randomBytes = random_bytes(10);
            $randomString = bin2hex($randomBytes);
            $password = $randomString;
        }
        $createdUser = User::create([
            'email' => $attributes['email'],
            'password' => $password,
            'role_id' => 3,
            'first_name' => $attributes['first_name'],
            'last_name' => $attributes['last_name'],
            'phone_number' => $attributes['phone_number'],
            'provider' => $provider,
        ]);

        $createdUser->profiles()->create([
            'birth_date' => $attributes['birth_date'],
            'specialty' => $attributes['specialty'],
            'gender' => $attributes['gender'],
        ]);

        return $createdUser->createToken('token')->plainTextToken;
    }
}
