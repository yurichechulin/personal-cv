<?php

declare(strict_types=1);

namespace App\Core\UI\Rest\Controller;

use App\Shared\Application\Command\CommandBusInterface;
use App\Shared\Application\Command\CommandInterface;
use App\Shared\Application\Query\QueryBusInterface;
use App\Shared\Application\Query\QueryInterface;

abstract class CommandQueryController
{
    protected CommandBusInterface $commandBus;

    protected QueryBusInterface $queryBus;

    /**
     * CommandQueryController constructor.
     * @param CommandBusInterface $commandBus
     * @param QueryBusInterface $queryBus
     */
    public function __construct(CommandBusInterface $commandBus,
                                QueryBusInterface $queryBus)
    {
        $this->commandBus = $commandBus;
        $this->queryBus = $queryBus;
    }


    /**
     * @param CommandInterface $command
     */
    protected function handle(CommandInterface $command) : void
    {
        $this->commandBus->handle($command);
    }

    /**
     * @param QueryInterface $query
     * @return mixed
     */
    protected function ask(QueryInterface $query)
    {
        return $this->queryBus->ask($query);
    }
}