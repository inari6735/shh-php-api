<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    public function __construct(
        EntityManagerInterface $entityManager
    )
    {
        parent::__construct($entityManager, $entityManager->getClassMetadata(User::class));
    }

    /**
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getUserByEmail(string $email): User | null
    {
        return $this->createQueryBuilder('u')
            ->where('u.email = :email')
            ->setParameter('email', $email)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getUserByTag(string $tag): User | null
    {
        return $this->createQueryBuilder('u')
            ->where('u.tag = :tag')
            ->setParameter('tag', $tag)
            ->getQuery()
            ->getOneOrNullResult();
    }
}