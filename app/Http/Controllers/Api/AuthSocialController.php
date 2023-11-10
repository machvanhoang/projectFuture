<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class AuthSocialController extends Controller
{
    /**
     * Summary of googleUrl
     * @return JsonResponse|mixed
     */
    public function googleUrl()
    {
        $url = Socialite::driver('google')->stateless()->redirect()->getTargetUrl();
        return response_success(['url' => $url], __('admin.auth.social.google.success'));
    }

    /**
     * Summary of googleLogin
     * @param Request $request
     * @return JsonResponse|mixed
     */
    public function googleLogin(Request $request)
    {
        try {
            $socialUser = Socialite::driver('google')->stateless()->user();
            $user = User::where('email', $socialUser->getEmail())->first();
            if (!$user) {
                $user = User::create([
                    'name' => $socialUser->getName(),
                    'email' => $socialUser->getEmail(),
                    'password' => bcrypt("admin"),
                ]);
            }
            $token = $user->createToken('access_token')->plainTextToken;
            return response_success(['token' => $token, 'user' => $user], __('admin.auth.social.google.success'));
        } catch (\Exception $e) {
            return response_error([$e->getMessage()]);
        }
    }


    /**
     * Summary of facebookUrl
     * @return JsonResponse|mixed
     */
    public function facebookUrl()
    {
        $url = Socialite::driver('facebook')->stateless()->redirect()->getTargetUrl();
        return response_success(['url' => $url], __('admin.auth.social.facebook.success'));
    }

    /**
     * Summary of facebookLogin
     * @param Request $request
     * @return JsonResponse|mixed
     */
    public function facebookLogin(Request $request)
    {
        try {
            $socialUser = Socialite::driver('facebook')->stateless()->user();
            $user = User::where('email', $socialUser->getEmail())->first();
            if (!$user) {
                $user = User::create([
                    'name' => $socialUser->getName(),
                    'email' => $socialUser->getEmail(),
                    'password' => bcrypt("admin"),
                ]);
            }
            $token = $user->createToken('access_token')->plainTextToken;
            return response_success(['token' => $token, 'user' => $user], __('admin.auth.social.facebook.success'));
        } catch (\Exception $e) {
            return response_error([$e->getMessage()]);
        }
    }
}
