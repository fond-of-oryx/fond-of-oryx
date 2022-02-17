<?php

namespace FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business;

interface ErpDeliveryNotePageSearchFacadeInterface
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
     * @param array<int> $erpDeliveryNoteIds
     *
     * @return void
     */
    public function publish(array $erpDeliveryNoteIds): void;

    /**
     * Specification:
     * - Finds and deletes erp order search entities based on these ids
     * - Sends delete message to queue based on module config
     *
     * @param array<int> $erpDeliveryNoteIds
     *
     * @return void
     */
    public function unpublish(array $erpDeliveryNoteIds): void;
}
