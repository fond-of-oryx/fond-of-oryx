<?php

namespace FondOfOryx\Glue\ErpOrderPageSearchRestApi;

use Spryker\Glue\Kernel\AbstractBundleConfig;

class ErpOrderPageSearchRestApiConfig extends AbstractBundleConfig
{
    public const RESOURCE_ERP_ORDERS = 'erp-orders';
    public const RESOURCE_ERP_ORDER = 'erp-order';
    public const RESOURCE_COMPANY_BUSINESS_UNIT = 'company-business-unit';
    public const RESOURCE_ERP_ORDER_PAGE_SEARCH_REST_API = 'erp-order-page-search';
    public const CONTROLLER_ERP_ORDER_PAGE_SEARCH_REST_API = 'erp-order-page-search-resource';
    public const ACTION_ERP_ORDER_PAGE_SEARCH_REST_API_POST = 'post';
    public const ACTION_ERP_ORDER_PAGE_SEARCH_REST_API_GET = 'get';
    public const DEFAULT_ITEMS_PER_PAGE = 12;
    public const PARAMETER_NAME_PAGE = 'page';
    public const PARAMETER_NAME_ITEMS_PER_PAGE = 'ipp';
    public const QUERY_STRING_PARAMETER = 'q';
}
