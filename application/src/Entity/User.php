<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\Interfaces\TimestampableInterface;
use App\Entity\Traits\Timestampable;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table('users')]
class User implements TimestampableInterface
{
    use Timestampable;

    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int|null $id = null;

    #[ORM\Column(type: 'string', length: 255, unique: true, nullable: false)]
    private string $email;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $password;

    #[ORM\Column(type: 'string', length: 30, unique: true, nullable: false)]
    private string $tag;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $username;

    public function __construct() {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function setTag(string $tag): self
    {
        $this->tag = $tag;
        return $this;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;
        return $this;
    }
}