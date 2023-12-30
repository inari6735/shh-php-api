<?php

declare(strict_types=1);

namespace App\Http\Component;

class Response
{
    public const HTTP_BAD_REQUEST = 400;
    public const NOT_FOUND_CODE = 404;
    public const CREATED_CODE = 201;

    public const HTTP_OK = 200;
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
    ): string
    {
        http_response_code($code);
        header('Content-Type: application/json; charset=utf-8');

        self::$responseData['data'] = [
            'errors' => $errors
        ];
        self::$responseData['success'] = false;
        self::$responseData['message'] = $message;

        return json_encode(self::$responseData);
    }

    public static function failtNotFound(
        string $message = 'Resource not found'
    ): string
    {
        http_response_code(self::NOT_FOUND_CODE);
        header('Content-Type: application/json; charset=utf-8');

        self::$responseData['success'] = false;
        self::$responseData['message'] = $message;

        return json_encode(self::$responseData);
    }

    public static function respondCreated(
        array $data = [],
        string $message = "Succesful created"
    ): string
    {
        http_response_code(self::CREATED_CODE);
        header('Content-Type: application/json; charset=utf-8');

        self::$responseData['message'] = $message;
        self::$responseData['data'] = $data;

        return json_encode(self::$responseData);
    }

    public static function respondSuccess(
        array $data = [],
        string $message = "Success"
    ): string
    {
        http_response_code(self::HTTP_OK);
        header('Content-Type: application/json; charset=utf-8');

        self::$responseData['message'] = $message;
        self::$responseData['data'] = $data;

        return json_encode(self::$responseData);
    }

    public static function failtNotAcceptable(
        string $message = "Invalid Content-Type. Only 'application/json' is accepted"
    ): string
    {
        http_response_code(self::NOT_ACCEPTABLE_CODE);
        header('Content-Type: application/json; charset=utf-8');

        self::$responseData['message'] = $message;

        return json_encode(self::$responseData);
    }

    public static function setCorsPolicy(): void {
        header("Access-Control-Allow-Origin: http://ec2-3-71-186-222.eu-central-1.compute.amazonaws.com");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Authorization, DNT, User-Agent, X-Requested-With, If-Modified-Since, Cache-Control, Range");
        header("Access-Control-Allow-Credentials: true");
        header("Access-Control-Max-Age: 3600");

        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            header("HTTP/1.1 200 OK");
            exit;
        }
    }
}