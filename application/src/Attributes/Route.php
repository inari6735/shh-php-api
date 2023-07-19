<?php

namespace App\Attributes;

use App\Entity\Enum\HTTPMethod;
use Attribute;

#[Attribute]
class Route
{
    public function __construct(
        public string $path,
        public HTTPMethod $method
    )
    {}
}