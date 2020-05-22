<?php

declare(strict_types=1);

namespace App\Core\Infrastructure\Repository\User;

use App\Core\Domain\Model\User\User;
use App\Core\Domain\Model\User\UserRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

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
}