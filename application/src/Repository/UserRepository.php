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

    public function getUserByEmail(string $email): User | null
    {
        return $this->createQueryBuilder('u')
            ->where('u.email = :email')
            ->setParameter('email', $email)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function getUserByTag(string $tag): User | null
    {
        return $this->createQueryBuilder('u')
            ->where('u.tag = :tag')
            ->setParameter('tag', $tag)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function save(User $user, bool $flush = true): void
    {
        $em = $this->getEntityManager();
        $em->persist($user);

        if ($flush) {
            $em->flush();
        }
    }

    public function searchByQueryString(string $queryString): array
    {
        $conn = $this->getEntityManager()->getConnection();
        $query = "
            SELECT id, email, tag, username FROM users WHERE MATCH(tag, username) AGAINST (? IN NATURAL LANGUAGE MODE);
        ";

        $stmt = $conn->prepare($query);
        $stmt->bindValue(1, $queryString);

        $results = $stmt->executeQuery()->fetchAllAssociative();

        return $results;
    }
}