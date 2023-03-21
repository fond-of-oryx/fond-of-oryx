<?php

namespace FondOfOryx\Shared\ErpDeliveryNotePageSearch;

interface ErpDeliveryNotePageSearchConstants
{
    /**
     * Specification:
     * - Queue name as used for processing erp order messages
     *
     * @api
     *
     * @var string
     */
    public const ERP_DELIVERY_NOTE_SYNC_SEARCH_QUEUE = 'sync.search.erp_delivery_note';

    /**
     * Specification:
     * - Queue name as used for error erp_delivery_note messages
     *
     * @api
     *
     * @var string
     */
    public const ERP_DELIVERY_NOTE_SYNC_SEARCH_ERROR_QUEUE = 'sync.search.erp_delivery_note.error';

    /**
     * Specification:
     * - Resource name, this will use for key generating
     *
     * @api
     *
     * @var string
     */
    public const ERP_DELIVERY_NOTE_RESOURCE_NAME = 'erp_delivery_note';

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
    public const FULL_TEXT_FIELDS = 'FOND_OF_ORYX:ERP_DELIVERY_NOTE_PAGE_SEARCH:FULL_TEXT_FIELDS';

    /**
     * @var string
     */
    public const FULL_TEXT_BOOSTED_FIELDS = 'FOND_OF_ORYX:ERP_DELIVERY_NOTE_PAGE_SEARCH:FULL_TEXT_BOOSTED_FIELDS';

    /**
     * @var string
     */
    public const TRACKING_DATA_BLACKLIST_FIELDS = 'FOND_OF_ORYX:ERP_DELIVERY_NOTE_PAGE_SEARCH:TRACKING_DATA_BLACKLIST_FIELDS';

    /**
     * @var array
     */
    public const TRACKING_DATA_BLACKLIST_FIELDS_DEFAULT = [
        'id_erp_delivery_note_tracking',
        'fk_erp_delivery_note',
        'shipping_agent_service_code',
        'created_at',
        'updated_at',
    ];

    /**
     * @var string
     */
    public const ITEM_DATA_BLACKLIST_FIELDS = 'FOND_OF_ORYX:ERP_DELIVERY_NOTE_PAGE_SEARCH:ITEM_DATA_BLACKLIST_FIELDS';

    /**
     * @var array
     */
    public const ITEM_DATA_BLACKLIST_FIELDS_DEFAULT = [
        'id_erp_delivery_note_item',
        'fk_erp_delivery_note',
        'created_at',
        'updated_at',
    ];
}
