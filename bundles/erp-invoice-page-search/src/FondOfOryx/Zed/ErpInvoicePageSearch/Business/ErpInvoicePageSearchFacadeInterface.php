<?php

namespace FondOfOryx\Zed\ErpInvoicePageSearch\Business;

interface ErpInvoicePageSearchFacadeInterface
{
    /**
     * Specification:
     * - Queries all erp orders with these ids
     * - Creates a data structure tree
     * - Stores data as json encoded to search table
     * - Sends a copy of data to queue based on module config
     *
     * @api
     *
     * @param array<int> $erpInvoiceIds
     *
     * @return void
     */
    public function publish(array $erpInvoiceIds): void;

    /**
     * Specification:
     * - Finds and deletes erp order search entities based on these ids
     * - Sends delete message to queue based on module config
     *
     * @param array<int> $erpInvoiceIds
     *
     * @return void
     */
    public function unpublish(array $erpInvoiceIds): void;
}
