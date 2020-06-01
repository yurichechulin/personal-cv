<?php

declare(strict_types=1);

namespace App\Core\Infrastructure\Repository\User;

use App\Core\Domain\Model\User\User;
use App\Core\Domain\Model\User\UserRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;
use Ramsey\Uuid\UuidInterface;

class UserRepository implements UserRepositoryInterface
{
    private EntityManagerInterface $_em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->_em = $em;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function save(User $user): bool
    {
        $this->_em->persist($user);
        $this->_em->flush();
        return true;
    }

    /**
     * @param string $email
     * @return User|null
     * @throws NonUniqueResultException
     */
    public function findOneByEmail(string $email): ?User
    {
        return $this->_em->createQueryBuilder()
                ->select('u')
                ->from(User::class, 'u')
                ->where('u.email = :email')
                ->setParameters(['email' => $email])
                ->getQuery()
                ->getOneOrNullResult();
    }

    /**
     * @param UuidInterface $uuid
     * @return User|null
     * @throws NonUniqueResultException
     */
    public function findOneByUuid(UuidInterface $uuid) : ?User
    {
        return $this->_em->createQueryBuilder()
            ->select('u')
            ->from(User::class, 'u')
            ->where('u.uuid = :uuid')
            ->setParameters(['uuid' => $uuid])
            ->getQuery()
            ->getOneOrNullResult();
    }
}