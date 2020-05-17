<?php


namespace App\Shared\Domain\Model;


interface EntityInterface
{
    /**
     * @return string
     */
    public function getUuid(): string;
}