<?php

declare(strict_types=1);

namespace App\Core\Application\Command\Post\CreatePost;

use App\Core\Application\Command\Post\PostCommand;
use App\Shared\Application\Command\CommandInterface;
use Ramsey\Uuid\UuidInterface;

class CreatePostCommand extends PostCommand implements CommandInterface
{
    protected UuidInterface $uuid;

    /**
     * @return UuidInterface
     */
    public function getUuid() : UuidInterface {
        return $this->uuid;
    }

    /**
     * @param UuidInterface $uuid
     */
    protected function setUuud(UuidInterface $uuid) : void {
        $this->uuid = $uuid;
    }
}