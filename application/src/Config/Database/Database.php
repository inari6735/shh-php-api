<?php

declare(strict_types=1);

namespace App\Config\Database;

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\Common\EventManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Driver\AttributeDriver;
use Gedmo\Timestampable\TimestampableListener;
use Symfony\Component\Cache\Adapter\ArrayAdapter;
use Symfony\Component\Cache\Adapter\PhpFilesAdapter;

class Database
{
    public function createEntityManager(): EntityManagerInterface
    {
        $entityFilesPaths = [__DIR__ . '/../../Entity'];
        $applicationMode = 'development';

        if ($applicationMode == 'development') {
            $queryCache = new ArrayAdapter();
            $metadataCache = new ArrayAdapter();
        } else {
            $queryCache = new PhpFilesAdapter('doctrine_queries');
            $metadataCache = new PhpFilesAdapter('doctrine_metadata');
        }

        $config = new Configuration();
        $config->setMetadataCache($metadataCache);
        $driverImpl = new AttributeDriver($entityFilesPaths);
        $config->setMetadataDriverImpl($driverImpl);
        $config->setQueryCache($queryCache);
        $config->setProxyDir(__DIR__ . '/Cache/Proxies');
        $config->setProxyNamespace('App\Config\Database\Cache\Proxies');

        if ($applicationMode == 'development') {
            $config->setAutoGenerateProxyClasses(true);
        } else {
            $config->setAutoGenerateProxyClasses(false);
        }

        $connection = DriverManager::getConnection([
            'url' => $_ENV['MYSQL_URL']
        ]);

        $eventManager = new EventManager();

        $timestampableListener = new TimestampableListener();
        $timestampableListener->setCacheItemPool($queryCache);
        $eventManager->addEventSubscriber($timestampableListener);

        return new EntityManager($connection, $config, $eventManager);
    }
}