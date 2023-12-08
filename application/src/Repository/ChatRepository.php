<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Chat;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class ChatRepository extends EntityRepository
{
    public function __construct(
        EntityManagerInterface $entityManager
    )
    {
        parent::__construct($entityManager, $entityManager->getClassMetadata(Chat::class));
    }

    public function getChatIdByFirstUserId(int $firstUserId): Chat | null
    {
        return $this->createQueryBuilder('c')
            ->where('c.firstUserId = :firstUserId')
            ->setParameter('firstUserId', $firstUserId)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function save(Chat $chat, bool $flush = true): void
    {
        $em = $this->getEntityManager();
        $em->persist($chat);

        if ($flush) {
            $em->flush();
        }
    }
}