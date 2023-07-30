<?php

declare(strict_types=1);

use App\Config\Database\Database;
use Doctrine\ORM\EntityManagerInterface;

return [
    EntityManagerInterface::class => function (Database $database) {
        return $database->createEntityManager();
    }
];