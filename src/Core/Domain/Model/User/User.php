<?php

declare(strict_types=1);

namespace App\Core\Domain\Model\User;

use App\Shared\Domain\Model\EntityInterface;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Entity()
 */
class User implements EntityInterface
{
    public const DEFAULT_USER_ROLE = 'ROLE_USER';
    public const MAX_EMAIL_LENGTH = 255;
    public const MAX_USER_NAME_LENGTH = 255;
    public const MAX_PASSWORD_LENGTH = 255;

    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     */
    private UuidInterface $uuid;

    /**
     * @ORM\Column(type="string", unique=true, length=255)
     */
    private string $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * @var array<int, string>
     *
     * @ORM\Column(type="json", nullable=false)
     */
    private array $roles = [];

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private string $password;

    /**
     * @ORM\Column(type="datetime_immutable", options={"default"="CURRENT_TIMESTAMP"}, nullable=false)
     */
    private DateTimeImmutable $createdAt;

    /**
     * User constructor.
     * @param string $email
     * @param string $name
     * @param array $roles
     * @param string $password
     * @param DateTimeImmutable $createdAt
     */
    public function __construct(string $email,
                                string $name,
                                array $roles,
                                string $password,
                                DateTimeImmutable $createdAt)
    {
        $this->setUuid(Uuid::uuid4());
        $this->setEmail($email);
        $this->setName($name);
        $this->setRoles($roles);
        $this->setPassword($password);
        $this->setCreatedAt($createdAt);
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
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getRoles(): array
    {
        return $this->roles;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function equals(User $user): bool
    {
        return $user->getUuid() === $this->getUuid();
    }

    /**
     * @param UuidInterface $uuid
     */
    private function setUuid(UuidInterface $uuid): void
    {
        $this->uuid = $uuid;
    }

    /**
     * @param string $email
     */
    private function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @param string $name
     */
    private function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param array $roles
     */
    private function setRoles(array $roles): void
    {
        $this->roles = $roles;
    }

    /**
     * @param string $password
     */
    private function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @param DateTimeImmutable $createdAt
     */
    private function setCreatedAt(DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }
}