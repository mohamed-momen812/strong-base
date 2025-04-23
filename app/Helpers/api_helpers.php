<?php

if (!function_exists('api_success')) {
    function api_success($data = null, string $message = '', int $status = 200, array $headers = [])
    {
        $response = [
            'success' => true,
            'data' => $data,
            'message' => $message,
        ];

        return response()->json($response, $status, $headers);
    }
}

if (!function_exists('api_error')) {
    function api_error(string $message = '', int $status = 400, array $errors = [], array $headers = [])
    {
        $response = [
            'success' => false,
            'message' => $message,
            'errors' => $errors,
        ];

        return response()->json($response, $status, $headers);
    }
}