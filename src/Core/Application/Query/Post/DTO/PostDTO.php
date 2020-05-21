<?php

declare(strict_types=1);

namespace App\Core\Application\Query\Post\DTO;

use App\Core\Domain\Model\Post\Post;
use DateTimeImmutable;

class PostDTO
{
    private string $uuid;

    private string $name;

    private string $description;

    private DateTimeImmutable $createdAt;

    /**
     * @param Post $post
     * @return PostDTO
     */
    public static function fromEntity(Post $post) : PostDTO {
        $dto = new static();

        $dto->setUuid($post->getUuid());
        $dto->setName($post->getTitle());
        $dto->setDescription($post->getDescription());
        $dto->setCreatedAt($post->getCreatedAt());

        return $dto;
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @param string $uuid
     */
    public function setUuid(string $uuid): void
    {
        $this->uuid = $uuid;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @param DateTimeImmutable $createdAt
     */
    public function setCreatedAt(DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }
}