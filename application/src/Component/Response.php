<?php

declare(strict_types=1);

namespace App\Component;

class Response
{
    private const NOT_FOUND_CODE = 404;
    private const CREATED_CODE = 201;
    private const NOT_ACCEPTABLE_CODE = 406;

    private static array $responseData = [
        'data' => [],
        'message' => '',
        'success' => true
    ];

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
        http_response_code(Response::CREATED_CODE);
        header('Content-Type: application/json; charset=utf-8');

        Response::$responseData['message'] = $message;
        Response::$responseData['data'] = $data;

        echo json_encode(Response::$responseData);
        exit();
    }

    public static function failtNotAcceptable(
        string $message = "Invalid Content-Type. Only 'application/json' is accepted"
    ): void
    {
        http_response_code(Response::NOT_ACCEPTABLE_CODE);
        header('Content-Type: application/json; charset=utf-8');

        Response::$responseData['message'] = $message;

        echo json_encode(Response::$responseData);
        exit();
    }
}