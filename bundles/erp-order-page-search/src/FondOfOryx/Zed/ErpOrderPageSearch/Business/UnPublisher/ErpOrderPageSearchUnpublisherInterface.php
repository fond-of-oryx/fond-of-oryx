<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch\Business\Model;

interface ErpOrderPageSearchUnpublisherInterface
{
    /**
     * @param int[] $erpOrderIds
     *
     * @return void
     */
    public function unpublish(array $erpOrderIds): void;
}
