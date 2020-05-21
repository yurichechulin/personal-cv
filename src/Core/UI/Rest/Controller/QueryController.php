<?php

declare(strict_types=1);

namespace App\Core\UI\Rest\Controller;

use App\Shared\Application\Query\QueryBusInterface;
use App\Shared\Application\Query\QueryInterface;

abstract class QueryController
{
    protected QueryBusInterface $queryBus;

    /**
     * QueryAction constructor.
     * @param QueryBusInterface $queryBus
     */
    public function __construct(QueryBusInterface $queryBus)
    {
        $this->queryBus = $queryBus;
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