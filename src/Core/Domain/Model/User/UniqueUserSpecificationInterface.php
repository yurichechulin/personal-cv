<?php

declare(strict_types=1);

namespace App\Core\Domain\Model\User;


use App\Core\Domain\Exception\User\EmailAlreadyExistsException;
use App\Shared\Domain\Exception\UuidAlreadyExistsException;
use Ramsey\Uuid\UuidInterface;

interface UniqueUserSpecificationInterface
{
    /**
     * @param UuidInterface $uuid
     * @param string $email
     * @return bool
     * @throws EmailAlreadyExistsException
     * @throws UuidAlreadyExistsException
     */
    public function isUserUnique(UuidInterface $uuid, string $email) : bool;
}