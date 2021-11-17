<?php

namespace FondOfOryx\Zed\JellyfishSalesOrder\Business\Trigger;

interface SalesOrderExportTriggerInterface
{
    /**
     * @return void
     */
    public function trigger(): void;
}
