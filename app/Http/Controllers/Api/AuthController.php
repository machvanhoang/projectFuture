<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AuthRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Summary of login
     * @param AuthRequest $request
     * @return JsonResponse|mixed
     */
    public function login(AuthRequest $request)
    {
        $data = $request->validated();
        if (!auth(WEB)->attempt($data)) {
            return response_error([
                'errors' => [
                    'error' => __('admin.auth.login.error'),
                ],
            ]);
        }
        $user = auth(WEB)->user();
        $token = $user->createToken('adminToken');
        return response_success([
            'user' => $user,
            'token' => $token->plainTextToken,
        ], __('admin.auth.login.success'));
    }

    /**
     * Summary of logout
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request)
    {
        $user = $request->user();
        if (!$user) {
            return response_error([
                'errors' => [
                    'error' => __('admin.auth.logout.error'),
                ],
            ]);
        }
        $user->currentAccessToken()->delete();
        return response_non_data();
    }

    /**
     * Summary of user
     * @param Request $request
     * @return JsonResponse
     */
    public function user(Request $request)
    {
        $user = $request->user();
        return response_success([
            'user' => $user,
        ], __('admin.auth.logout.success'));
    }
}
