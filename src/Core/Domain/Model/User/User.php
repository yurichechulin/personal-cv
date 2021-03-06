<?php

declare(strict_types=1);

namespace App\Core\Domain\Model\User;

use App\Core\Domain\Exception\User\EmailAlreadyExistsException;
use App\Shared\Domain\Exception\UuidAlreadyExistsException;
use App\Shared\Domain\Model\EntityInterface;
use App\Shared\Domain\Service\Assert\Assert;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity()
 * @ORM\Table(name="app_user")
 */
class User implements EntityInterface, UserInterface
{
    public const DEFAULT_USER_ROLE = 'ROLE_USER';

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
     * @ORM\Column(type="string", nullable=false)
     */
    private string $hashedPassword;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $userName;

    /**
     * @var array<int, string>
     *
     * @ORM\Column(type="json", nullable=false)
     */
    private array $roles = [];

    /**
     * @ORM\Column(type="datetime_immutable", options={"default"="CURRENT_TIMESTAMP"}, nullable=false)
     */
    private DateTimeImmutable $createdAt;


    /**
     * User constructor.
     * @param UniqueUserSpecificationInterface $uniqueUserSpecification
     * @param UuidInterface $uuid
     * @param string $email
     * @param string $password
     * @param string $userName
     * @param string[] $roles
     * @throws EmailAlreadyExistsException
     * @throws UuidAlreadyExistsException
     */
    public function __construct(UniqueUserSpecificationInterface $uniqueUserSpecification,
                                UuidInterface $uuid,
                                string $email,
                                string $password,
                                string $userName,
                                array $roles = [self::DEFAULT_USER_ROLE])
    {
        $uniqueUserSpecification->isUserUnique($uuid, $email);

        $this->setUuid($uuid);
        $this->setEmail($email);
        $this->setName($userName);
        $this->setRoles($roles);
        $this->setPassword($password);
        $this->setCreatedAt(new DateTimeImmutable());
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
    public function getUsername(): string
    {
        return $this->userName;
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
        return $this->hashedPassword;
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
        Assert::email($email, "???????? ???????????? ???????? email-????");
        $this->email = $email;
    }

    /**
     * @param string $userName
     */
    private function setName(string $userName): void
    {
        $this->userName = $userName;
    }

    /**
     * @param array $roles
     */
    private function setRoles(array $roles): void
    {
        foreach ($roles as $role) {
            $this->addRole($role);
        }
    }

    /**
     * @param string $hashedPassword
     */
    private function setPassword(string $hashedPassword): void
    {
        Assert::maxLength($hashedPassword, self::MAX_PASSWORD_LENGTH, 'Password should contain at most %2$s characters. Got: %s');
        $this->hashedPassword = $hashedPassword;
    }

    /**
     * @param DateTimeImmutable $createdAt
     */
    private function setCreatedAt(DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @param string $role
     */
    private function addRole(string $role) : void {
        $this->roles[] = $role;
    }

    /**
     * @return string
     */
    public function getSalt() : string
    {
        return '';
    }

    public function eraseCredentials() : void
    {
        // TODO: Implement eraseCredentials() method.
    }

    /**
     * @return string
     */
    public function getUserIdentifier() : string
    {
        return $this->email;
    }
}