<?php

namespace FondOfOryx\Zed\JellyfishSalesOrder\Persistence;

interface JellyfishSalesOrderRepositoryInterface
{
    /**
     * @param string $name
     *
     * @return int|null
     */
    public function getIdOmsOrderItemStateByName(string $name): ?int;
}
