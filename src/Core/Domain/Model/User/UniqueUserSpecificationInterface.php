<?php

declare(strict_types=1);

namespace App\Core\Domain\Model\User;


use Ramsey\Uuid\UuidInterface;

interface UniqueUserSpecificationInterface
{
    /**
     * @param UuidInterface $uuid
     * @param string $email
     * @return bool
     */
    public function isUserUnique(UuidInterface $uuid, string $email) : bool;
}