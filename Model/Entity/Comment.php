<?php


namespace Model\Entity;


class Comment
{
    private ?int $id;
    private ?string $content;
    private ?User $author;

    /**
     * Comment constructor.
     * @param int|null $id
     * @param string|null $content
     * @param User|null $author
     */
    public function __construct(int $id = null, string $content = null, User $author = null)
    {
        $this->id = $id;
        $this->content = $content;
        $this->author = $author;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): Comment
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param string|null $content
     */
    public function setContent(?string $content): Comment
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return User|null
     */
    public function getAuthor(): ?User
    {
        return $this->author;
    }

    /**
     * @param User|null $author
     * @return $this
     */
    public function setAuthor(?User $author): Comment
    {
        $this->author = $author;
        return $this;
    }


}