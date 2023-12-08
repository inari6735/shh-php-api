<?php

declare(strict_types=1);

namespace App\Http\Controller;

use App\Config\Attributes\Route;
use App\Entity\Enum\HTTPMethod;
use App\Http\Component\Request;
use App\Http\Component\Response;
use App\Http\Service\MessageService;

readonly class MessageController
{
    public function __construct(
        private Request $request,
        private MessageService $service
    )
    {}

    #[Route(path: '/message', method: HTTPMethod::POST)]
    public function persistMessage(): string
    {
        $msg = $this->request->getBody();
    }

    #[Route(path: '/chat', method: HTTPMethod::POST)]
    public function processChat(): string
    {
        $request = $this->request->getBody();
        $firstUserId = $request['firstUserId'];
        $secondUserId = $request['secondUserId'];

        $chatId = $this->service->processChat($firstUserId, $secondUserId);

        return Response::respondCreated(['chatId' => $chatId]);
    }
}