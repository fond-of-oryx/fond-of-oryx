<?php

namespace FondOfOryx\Zed\ErpOrder\Dependency;

interface ErpOrderEvents
{
    /**
     * Specification:
     * - This event will be used for foo_erp_order entity creation
     *
     * @api
     */
    public const ENTITY_FOO_ERP_ORDER_CREATE = 'Entity.foo_erp_order.create';

    /**
     * Specification:
     * - This event will be used for foo_erp_order entity update
     *
     * @api
     */
    public const ENTITY_FOO_ERP_ORDER_UPDATE = 'Entity.foo_erp_order.update';

    /**
     * Specification:
     * - This event will be used for foo_erp_order entity delete
     *
     * @api
     */
    public const ENTITY_FOO_ERP_ORDER_DELETE = 'Entity.foo_erp_order.delete';

    /**
     * Specification
     * - This events will be used for erp_order publishing
     *
     * @api
     */
    public const ERP_ORDER_PUBLISH = 'ErpOrder.erp_order.publish';

    /**
     * Specification
     * - This events will be used for erp_order un-publishing
     *
     * @api
     */
    public const ERP_ORDER_UNPUBLISH = 'ErpOrder.erp_order.unpublish';
}
