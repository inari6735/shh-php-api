<?php

declare(strict_types=1);

namespace App\Component;

class Response
{
    private const NOT_FOUND_CODE = 404;
    private static array $responseData = [
        'data' => [],
        'message' => '',
        'success' => true
    ];

    public static function notFound(
        string $message = 'Nie znaleziono zasobu'
    ): void
    {
        http_response_code(Response::NOT_FOUND_CODE);
        header('Content-Type: application/json; charset=utf-8');

        Response::$responseData['success'] = false;
        Response::$responseData['message'] = $message;

        echo json_encode(Response::$responseData);
        exit();
    }
}