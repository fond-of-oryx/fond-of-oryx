<?php

namespace FondOfOryx\Zed\ErpDeliveryNote\Dependency;

interface ErpDeliveryNoteEvents
{
    /**
     * Specification:
     * - This event will be used for foo_erp_delivery_note entity creation
     *
     * @api
     *
     * @var string
     */
    public const ENTITY_FOO_ERP_DELIVERY_NOTE_CREATE = 'Entity.foo_erp_delivery_note.create';

    /**
     * Specification:
     * - This event will be used for foo_erp_delivery_note entity update
     *
     * @api
     *
     * @var string
     */
    public const ENTITY_FOO_ERP_DELIVERY_NOTE_UPDATE = 'Entity.foo_erp_delivery_note.update';

    /**
     * Specification:
     * - This event will be used for foo_erp_delivery_note entity delete
     *
     * @api
     *
     * @var string
     */
    public const ENTITY_FOO_ERP_DELIVERY_NOTE_DELETE = 'Entity.foo_erp_delivery_note.delete';

    /**
     * Specification
     * - This events will be used for erp_delivery_note publishing
     *
     * @api
     *
     * @var string
     */
    public const ERP_DELIVERY_NOTE_PUBLISH = 'ErpDeliveryNote.erp_delivery_note.publish';

    /**
     * Specification
     * - This events will be used for erp_delivery_note un-publishing
     *
     * @api
     *
     * @var string
     */
    public const ERP_DELIVERY_NOTE_UNPUBLISH = 'ErpDeliveryNote.erp_delivery_note.unpublish';
}
