<?php

namespace FondOfOryx\Zed\ErpInvoicePageSearch\Persistence;

use Generated\Shared\Transfer\FilterTransfer;

interface ErpInvoicePageSearchRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\FilterTransfer $filterTransfer
     * @param array<int> $erpInvoiceIds
     *
     * @return array<\Generated\Shared\Transfer\FooErpInvoicePageSearchEntityTransfer>
     */
    public function findFilteredErpInvoicePageSearchEntities(
        FilterTransfer $filterTransfer,
        array $erpInvoiceIds = []
    ): array;
}
