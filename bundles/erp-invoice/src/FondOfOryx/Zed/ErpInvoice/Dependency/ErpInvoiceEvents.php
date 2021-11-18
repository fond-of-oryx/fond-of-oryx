<?php

namespace FondOfOryx\Zed\ErpInvoice\Dependency;

interface ErpInvoiceEvents
{
    /**
     * Specification:
     * - This event will be used for foo_erp_invoice entity creation
     *
     * @api
     *
     * @var string
     */
    public const ENTITY_FOO_ERP_INVOICE_CREATE = 'Entity.foo_erp_invoice.create';

    /**
     * Specification:
     * - This event will be used for foo_erp_invoice entity update
     *
     * @api
     *
     * @var string
     */
    public const ENTITY_FOO_ERP_INVOICE_UPDATE = 'Entity.foo_erp_invoice.update';

    /**
     * Specification:
     * - This event will be used for foo_erp_invoice entity delete
     *
     * @api
     *
     * @var string
     */
    public const ENTITY_FOO_ERP_INVOICE_DELETE = 'Entity.foo_erp_invoice.delete';

    /**
     * Specification
     * - This events will be used for erp_invoice publishing
     *
     * @api
     *
     * @var string
     */
    public const ERP_INVOICE_PUBLISH = 'ErpInvoice.erp_invoice.publish';

    /**
     * Specification
     * - This events will be used for erp_invoice un-publishing
     *
     * @api
     *
     * @var string
     */
    public const ERP_INVOICE_UNPUBLISH = 'ErpInvoice.erp_invoice.unpublish';
}
