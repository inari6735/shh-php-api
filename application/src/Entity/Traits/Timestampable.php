<?php

declare(strict_types=1);

namespace App\Entity\Traits;

use DateTime;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

trait Timestampable
{
    #[ORM\Column(name: 'createdAt', type: 'datetime', nullable: true)]
    private DateTime $createdAt;

    #[ORM\Column(name: 'updatedAt', type: 'datetime', nullable: true)]
    private DateTime $updatedAt;

    public function setCreatedAt(DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function setUpdatedAt(DateTime $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }
}