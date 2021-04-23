<?php

namespace Model\Entity;

class Article {

    private ?int $id;
    private string $content;
    private User $user;

    /**
     * Article constructor.
     * @param int|null $id
     * @param string $content
     * @param User $user
     */
    public function __construct(string $content, User $user, int $id= null) {
        $this->id = $id;
        $this->content = $content;
        $this->user = $user;
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
    public function setId(?int $id): void {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getContent(): string {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void {
        $this->content = $content;
    }

    /**
     * @return User
     */
    public function getUser(): User {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void {
        $this->user = $user;
    }
}