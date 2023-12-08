<?php

declare(strict_types=1);

namespace App\Config\Database;

use App\Http\Exception\RedisConnectionException;
use Redis;
use RedisException;

class RedisConnector
{
    /**
     * @throws RedisException
     * @throws RedisConnectionException
     */
    public function createConnection(): Redis
    {
         $redis = new Redis();
         $redis->connect('redis', 6379);
         $redis->auth('redispwd');

         if (!$redis->ping()) {
             throw new RedisConnectionException(['Connection is lost']);
         }

         return $redis;
    }
}