<?php

namespace FondOfOryx\Shared\JellyfishSalesOrder;

interface JellyfishSalesOrderConstants
{
    /**
     * @var string
     */
    public const BASE_URI = 'JELLYFISH_SALES_ORDER:BASE_URI';

    /**
     * @var string
     */
    public const TIMEOUT = 'JELLYFISH_SALES_ORDER:TIMEOUT';

    /**
     * @var string
     */
    public const USERNAME = 'JELLYFISH_SALES_ORDER:USERNAME';

    /**
     * @var string
     */
    public const PASSWORD = 'JELLYFISH_SALES_ORDER:PASSWORD';

    /**
     * @var string
     */
    public const SYSTEM_CODE = 'JELLYFISH_SALES_ORDER:SYSTEM_CODE';

    /**
     * @var string
     */
    public const DRY_RUN = 'JELLYFISH_SALES_ORDER:DRY_RUN';

    /**
     * @var string
     */
    public const BLACKLISTED_PAYMENT_METHODS = 'JELLYFISH_SALES_ORDER:BLACKLISTED_PAYMENT_METHODS';

    /**
     * @var string
     */
    public const EXPORT_PENDING_STATE_NAME = 'JELLYFISH_SALES_ORDER:EXPORT_PENDING_STATE_NAME';

    /**
     * @var string
     */
    public const EXPORT_PENDING_STATE_NAME_DEFAULT = 'export pending';

    /**
     * @var string
     */
    public const EXPORT_EVENT_NAME = 'JELLYFISH_SALES_ORDER:EXPORT_EVENT_NAME';

    /**
     * @var string
     */
    public const EXPORT_EVENT_NAME_DEFAULT = 'export';

    /**
     * @var string
     */
    public const MAX_ORDER_AGE_IN_DAYS = 'JELLYFISH_SALES_ORDER:PAYONE:MAX_ORDER_AGE_IN_DAYS';

    /**
     * @var int
     */
    public const MAX_ORDER_AGE_IN_DAYS_DEFAULT = 7;
}
