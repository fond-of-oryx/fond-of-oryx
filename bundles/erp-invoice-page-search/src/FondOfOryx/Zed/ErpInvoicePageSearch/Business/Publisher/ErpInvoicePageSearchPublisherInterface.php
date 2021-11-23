<?php

namespace FondOfOryx\Zed\ErpInvoicePageSearch\Business\Publisher;

interface ErpInvoicePageSearchPublisherInterface
{
    /**
     * @param array<int> $erpInvoiceIds
     *
     * @return void
     */
    public function publish(array $erpInvoiceIds): void;
}
