<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch\Business\Publisher;

interface ErpOrderPageSearchPublisherInterface
{
    /**
     * @param array<int> $erpOrderIds
     *
     * @return void
     */
    public function publish(array $erpOrderIds): void;
}
