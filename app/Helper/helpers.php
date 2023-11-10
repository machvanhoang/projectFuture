<?php

if (!function_exists("response_error")) {
    /**
     * Summary of response_error
     * @param array|object|string $error
     * @param int $code
     * @return Illuminate\Http\JsonResponse|mixed
     */
    function response_error(array | object | string $error, int $code = 404)
    {
        $response = [
            'success' => false,
        ];

        if (!empty($error)) {
            $response['errors'] = $error;
        }

        return response()->json($response, $code);
    }
}

if (!function_exists("response_non_data")) {
    /**
     * Handle non-data response.
     *
     * @return Illuminate\Http\JsonResponse|mixed
     */
    function response_non_data()
    {
        return response()->json(204);
    }
}

if (!function_exists("response_success")) {
    /**
     * Summary of response_success
     * @param array|object|string $data
     * @param string $message
     * @param int $code
     * @return Illuminate\Http\JsonResponse|mixed
     */
    function response_success(array | object | string $data, string $message, int $code = 200)
    {
        $response = [
            'success' => true,
            'data' => $data,
            'message' => $message,
        ];

        return response()->json($response, $code);
    }
}
