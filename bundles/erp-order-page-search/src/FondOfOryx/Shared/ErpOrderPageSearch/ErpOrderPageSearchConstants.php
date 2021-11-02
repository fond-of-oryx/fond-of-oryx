<?php

namespace FondOfOryx\Shared\ErpOrderPageSearch;

interface ErpOrderPageSearchConstants
{
    /**
     * Specification:
     * - Queue name as used for processing erp order messages
     *
     * @api
     *
     * @var string
     */
    public const ERP_ORDER_SYNC_SEARCH_QUEUE = 'sync.search.erp_order';

    /**
     * Specification:
     * - Queue name as used for error erp_order messages
     *
     * @api
     *
     * @var string
     */
    public const ERP_ORDER_SYNC_SEARCH_ERROR_QUEUE = 'sync.search.erp_order.error';

    /**
     * Specification:
     * - Resource name, this will use for key generating
     *
     * @api
     *
     * @var string
     */
    public const ERP_ORDER_RESOURCE_NAME = 'erp_order';

    /**
     * @var string
     */
    public const PARAMETER_COMPANY_BUSINESS_UNIT_UUID = 'company-business-unit-uuid';

    /**
     * @var string
     */
    public const PARAMETER_EXTERNAL_REFERENCE = 'external-reference';

    /**
     * @var string
     */
    public const PARAMETER_REFERENCE = 'reference';

    /**
     * @var string
     */
    public const PARAMETER_MIN_OUTSTANDING_QUANTITY = 'min-outstanding-quantity';
}
