<?php

declare(strict_types=1);

namespace App\Entity\Traits;

use DateTime;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

trait Timestampable
{
    #[ORM\Column(name: 'createdAt', nullable: true)]
    #[Gedmo\Timestampable(on: 'create')]
    private DateTime $createdAt;

    #[ORM\Column(name: 'updatedAt', nullable: true)]
    #[Gedmo\Timestampable(on: 'update')]
    private DateTime $updatedAt;

    /**
     * @param DateTime $createdAt
     * @return Timestampable
     */
    public function setCreatedAt(DateTime $createdAt): Timestampable
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @param DateTime $updatedAt
     * @return Timestampable
     */
    public function setUpdatedAt(DateTime $updatedAt): Timestampable
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}