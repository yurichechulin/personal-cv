<?php

declare(strict_types=1);

namespace App\Core\Domain\Model\User;

interface UserRepositoryInterface
{
    /**
     * @param User $user
     * @return bool
     */
    public function save(User $user) : bool;
}