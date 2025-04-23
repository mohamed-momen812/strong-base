<?php

if (!function_exists('api_response')) {
    function api_response($data = null, $message = '', $status = 200, array $headers = [])
    {
        $response = [
            'success' => $status >= 200 && $status < 300,
            'message' => $message,
            'data' => $data,
        ];

        return response()->json($response, $status, $headers);
    }
}