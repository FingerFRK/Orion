<?php

namespace App\Entity;

use Core\Entity\Entity;

class TestEntity extends Entity {

    /**
     * ID
     */
    protected $id;

    /**
     * Username
     */
    protected $username;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }
    
}