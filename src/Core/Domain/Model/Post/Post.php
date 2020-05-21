<?php

declare(strict_types=1);

namespace App\Core\Domain\Model\Post;

use App\Core\Domain\Model\User\User;
use App\Shared\Domain\Model\EntityInterface;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Entity()
 */
class Post implements EntityInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     */
    private UuidInterface $uuid;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $title;

    /**
     * @ORM\Column(type="text")
     */
    private string $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Core\Domain\Model\User\User")
     * @ORM\JoinColumn(name="user_uuid", referencedColumnName="uuid", nullable=true, onDelete="cascade", nullable=false)
     */
    private User $user;

    /**
     * @ORM\Column(type="datetime_immutable", options={"default"="CURRENT_TIMESTAMP"}, nullable=false)
     */
    private DateTimeImmutable $createdAt;

    /**
     * Post constructor.
     * @param UuidInterface $uuid
     * @param string $name
     * @param string $description
     * @param User $user
     */
    public function __construct(UuidInterface $uuid, string $name, string $description, User $user)
    {
        $this->setUuid($uuid);
        $this->setName($name);
        $this->setDescription($description);
        $this->setCreatedAt(new DateTimeImmutable());
        $this->setUser($user);
    }

    /**
     * @param string $name
     */
    public function changeName(string $name): void
    {
        $this->setName($name);
    }

    /**
     * @param string $description
     */
    public function changeDescription(string $description): void
    {
        $this->setDescription($description);
    }

    /**
     * @return UuidInterface
     */
    public function getUuid(): UuidInterface
    {
        return $this->uuid;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
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
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param string $name
     */
    private function setName(string $name): void
    {
        $this->title = $name;
    }

    /**
     * @param string $description
     */
    private function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @param UuidInterface $uuid
     */
    private function setUuid(UuidInterface $uuid): void
    {
        $this->uuid = $uuid;
    }

    /**
     * @param DateTimeImmutable $createdAt
     */
    private function setCreatedAt(DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @param User $user
     */
    private function setUser(User $user): void
    {
        $this->user = $user;
    }
}