<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch\Business\Publisher;

interface ErpOrderPageSearchPublisherInterface
{
    /**
     * @param int[] $erpOrderIds
     *
     * @return void
     */
    public function publish(array $erpOrderIds): void;
}
