<?php

namespace FondOfOryx\Shared\ErpInvoicePageSearch;

interface ErpInvoicePageSearchConstants
{
    /**
     * Specification:
     * - Queue name as used for processing erp order messages
     *
     * @api
     *
     * @var string
     */
    public const ERP_INVOICE_SYNC_SEARCH_QUEUE = 'sync.search.erp_invoice';

    /**
     * Specification:
     * - Queue name as used for error erp_invoice messages
     *
     * @api
     *
     * @var string
     */
    public const ERP_INVOICE_SYNC_SEARCH_ERROR_QUEUE = 'sync.search.erp_invoice.error';

    /**
     * Specification:
     * - Resource name, this will use for key generating
     *
     * @api
     *
     * @var string
     */
    public const ERP_INVOICE_RESOURCE_NAME = 'erp_invoice';

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
    public const PARAMETER_ORDER_REFERENCE = 'order-reference';

    /**
     * @var string
     */
    public const PARAMETER_REFERENCE = 'reference';
}
