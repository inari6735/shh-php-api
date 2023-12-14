<?php

declare(strict_types=1);

namespace App\Http\Controller;

use App\Config\Attributes\Route;
use App\Entity\Enum\HTTPMethod;
use App\Http\Component\Request;
use App\Http\Component\Response;
use App\Http\Exception\JWTNotFoundException;
use App\Http\Service\MessageService;

readonly class MessageController
{
    public function __construct(
        private Request $request,
        private MessageService $service
    )
    {}

    /**
     * @throws \RedisException
     * @throws JWTNotFoundException
     */
    #[Route(path: '/message', method: HTTPMethod::POST)]
    public function persistMessage(): string
    {
        $identifier = $this->request->getUserIdentifier();
        $chatId = $this->request->getQueryParam('chatId');
        $data = $this->request->getBody();
        $ttl = (int)$this->request->getQueryParam('ttl');

        $this->service->persistMsg($data, $chatId, $ttl);

        return Response::respondCreated();
    }

    /**
     * @throws \RedisException
     * @throws JWTNotFoundException
     */
    #[Route(path: '/chat', method: HTTPMethod::POST)]
    public function processChat(): string
    {
        $identifier = $this->request->getUserIdentifier();
        $request = $this->request->getBody();
        $firstUserId = $request['firstUserId'];
        $secondUserId = $request['secondUserId'];

        $chatId = $this->service->processChat($firstUserId, $secondUserId);

        return Response::respondCreated(['chatId' => $chatId]);
    }

    /**
     * @throws JWTNotFoundException
     * @throws \RedisException
     */
    #[Route(path: '/chat', method: HTTPMethod::GET)]
    public function getMessages(): string
    {
        $identifier = $this->request->getUserIdentifier();
        $chatId = $this->request->getQueryParam('chatId');

        $messages = $this->service->getMessages($chatId);

        return Response::respondCreated(['messages' => $messages]);
    }
}