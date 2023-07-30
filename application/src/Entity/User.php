<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\Traits\Timestampable;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table('users')]
class User
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

    /**
     * @param string $email
     * @return User
     */
    public function setEmail(string $email): User
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @param string $password
     * @return User
     */
    public function setPassword(string $password): User
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @param string $tag
     * @return User
     */
    public function setTag(string $tag): User
    {
        $this->tag = $tag;
        return $this;
    }

    /**
     * @param string $username
     * @return User
     */
    public function setUsername(string $username): User
    {
        $this->username = $username;
        return $this;
    }


}