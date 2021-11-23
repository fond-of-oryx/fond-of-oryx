<?php

namespace FondOfOryx\Zed\ErpInvoicePageSearch\Business\UnPublisher;

interface ErpInvoicePageSearchUnpublisherInterface
{
    /**
     * @param array<int> $erpInvoiceIds
     *
     * @return void
     */
    public function unpublish(array $erpInvoiceIds): void;
}
