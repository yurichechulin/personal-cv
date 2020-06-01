<?php

declare(strict_types=1);

namespace App\Core\Domain\Model\User;

use Doctrine\ORM\NonUniqueResultException;
use Ramsey\Uuid\UuidInterface;

interface UserRepositoryInterface
{
    /**
     * @param User $user
     * @return bool
     */
    public function save(User $user) : bool;

    /**
     * @param string $email
     * @return User|null
     * @throws NonUniqueResultException
     */
    public function findOneByEmail(string $email): ?User;

    /**
     * @param UuidInterface $uuid
     * @return User|null
     * @throws NonUniqueResultException
     */
    public function findOneByUuid(UuidInterface $uuid) : ?User;
}