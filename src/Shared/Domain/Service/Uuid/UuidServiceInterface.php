<?php

namespace App\Shared\Domain\Service\Uuid;

use Ramsey\Uuid\UuidInterface;

interface UuidServiceInterface
{
    public function generate() : UuidInterface;
}