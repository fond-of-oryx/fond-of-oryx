<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch\Business\Model;

interface ErpOrderPageSearchPublisherInterface
{
    /**
     * @param int[] $erpOrderIds
     *
     * @return void
     */
    public function publish(array $erpOrderIds): void;
}
