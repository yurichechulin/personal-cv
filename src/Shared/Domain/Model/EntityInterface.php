<?php


namespace App\Shared\Domain\Model;


use Ramsey\Uuid\UuidInterface;

interface EntityInterface
{
    /**
     * @return UuidInterface
     */
    public function getUuid(): UuidInterface;
}