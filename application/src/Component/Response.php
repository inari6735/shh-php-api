<?php

declare(strict_types=1);

namespace App\Component;

class Response
{
    public const HTTP_BAD_REQUEST = 400;
    public const NOT_FOUND_CODE = 404;
    public const CREATED_CODE = 201;
    public const NOT_ACCEPTABLE_CODE = 406;

    private static array $responseData = [
        'data' => [],
        'message' => '',
        'success' => true
    ];

    public static function fail(
        array $errors = [],
        string $message = 'Request failure',
        int $code = self::HTTP_BAD_REQUEST
    ): void
    {
        http_response_code($code);
        header('Content-Type: application/json; charset=utf-8');

        self::$responseData['data'] = [
            'errors' => $errors
        ];
        self::$responseData['success'] = false;
        self::$responseData['message'] = $message;

        echo json_encode(self::$responseData);
        exit();
    }

    public static function failtNotFound(
        string $message = 'Resource not found'
    ): void
    {
        http_response_code(Response::NOT_FOUND_CODE);
        header('Content-Type: application/json; charset=utf-8');

        Response::$responseData['success'] = false;
        Response::$responseData['message'] = $message;

        echo json_encode(Response::$responseData);
        exit();
    }

    public static function respondCreated(
        array $data = [],
        string $message = "Succesful created"
    ): void
    {
        http_response_code(self::CREATED_CODE);
        header('Content-Type: application/json; charset=utf-8');

        self::$responseData['message'] = $message;
        self::$responseData['data'] = $data;

        echo json_encode(self::$responseData);
        exit();
    }

    public static function failtNotAcceptable(
        string $message = "Invalid Content-Type. Only 'application/json' is accepted"
    ): void
    {
        http_response_code(self::NOT_ACCEPTABLE_CODE);
        header('Content-Type: application/json; charset=utf-8');

        self::$responseData['message'] = $message;

        echo json_encode(self::$responseData);
        exit();
    }
}