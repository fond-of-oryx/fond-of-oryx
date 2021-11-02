<?php

namespace FondOfOryx\Glue\ErpOrderPageSearchRestApi;

use Spryker\Glue\Kernel\AbstractBundleConfig;

class ErpOrderPageSearchRestApiConfig extends AbstractBundleConfig
{
    /**
     * @var string
     */
    public const RESOURCE_ERP_ORDERS = 'erp-orders';

    /**
     * @var string
     */
    public const RESOURCE_ERP_ORDER = 'erp-order';

    /**
     * @var string
     */
    public const RESOURCE_COMPANY_BUSINESS_UNIT = 'company-business-unit';

    /**
     * @var string
     */
    public const RESOURCE_ERP_ORDER_PAGE_SEARCH_REST_API = 'erp-order-page-search';

    /**
     * @var string
     */
    public const CONTROLLER_ERP_ORDER_PAGE_SEARCH_REST_API = 'erp-order-page-search-resource';

    /**
     * @var string
     */
    public const ACTION_ERP_ORDER_PAGE_SEARCH_REST_API_POST = 'post';

    /**
     * @var string
     */
    public const ACTION_ERP_ORDER_PAGE_SEARCH_REST_API_GET = 'get';

    /**
     * @var int
     */
    public const DEFAULT_ITEMS_PER_PAGE = 12;

    /**
     * @var string
     */
    public const PARAMETER_NAME_PAGE = 'page';

    /**
     * @var string
     */
    public const PARAMETER_NAME_ITEMS_PER_PAGE = 'ipp';

    /**
     * @var string
     */
    public const QUERY_STRING_PARAMETER = 'q';
}
