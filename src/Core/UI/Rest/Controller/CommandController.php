<?php

declare(strict_types=1);

namespace App\Core\UI\Rest\Controller;

use App\Shared\Application\Command\CommandBusInterface;
use App\Shared\Application\Command\CommandInterface;

abstract class CommandController
{
    protected CommandBusInterface $commandBus;

    /**
     * CreatePostAction constructor.
     * @param CommandBusInterface $commandBus
     */
    public function __construct(CommandBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    /**
     * @param CommandInterface $command
     */
    protected function handle(CommandInterface $command) : void
    {
        $this->commandBus->handle($command);
    }
}