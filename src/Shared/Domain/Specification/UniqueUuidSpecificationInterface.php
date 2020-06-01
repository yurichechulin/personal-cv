<?php


namespace App\Shared\Domain\Specification;


use Ramsey\Uuid\UuidInterface;

interface UniqueUuidSpecificationInterface
{
    /**
     * @param UuidInterface $uuid
     * @return bool
     */
    public function isUuidUnique(UuidInterface $uuid) : bool;
}