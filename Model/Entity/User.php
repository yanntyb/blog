<?php

namespace Model\Entity;

class User {

    private ?int $id;
    private ?string $username;
    private ?string $password;
    private ?int $admin;
    /**
     * User constructor.
     * @param string|null $username
     * @param string|null $password
     * @param int|null $id
     */
    public function __construct(string $username = null, string $password = null,int $admin = null , ?int $id = null) {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->admin = $admin;
    }


    /**
     * @return int|null
     */
    public function getId(): ?int {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): User {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getUsername(): string {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): User {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): User {
        $this->password = $password;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getAdmin(): ?int
    {
        return $this->admin;
    }

    /**
     * @param int|null $admin
     * @return $this
     */
    public function setAdmin(?int $admin): User
    {
        $this->admin = $admin;
        return $this;
    }



}