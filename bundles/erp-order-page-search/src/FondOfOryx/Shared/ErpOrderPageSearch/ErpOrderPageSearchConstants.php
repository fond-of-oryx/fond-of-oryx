<?php

namespace FondOfOryx\Shared\ErpOrderPageSearch;

interface ErpOrderPageSearchConstants
{
    /**
     * Specification:
     * - Queue name as used for processing erp order messages
     *
     * @api
     */
    public const ERP_ORDER_SYNC_SEARCH_QUEUE = 'sync.search.erp_order';

    /**
     * Specification:
     * - Queue name as used for error erp_order messages
     *
     * @api
     */
    public const ERP_ORDER_SYNC_SEARCH_ERROR_QUEUE = 'sync.search.erp_order.error';

    /**
     * Specification:
     * - Resource name, this will use for key generating
     *
     * @api
     */
    public const ERP_ORDER_RESOURCE_NAME = 'erp_order';
}
