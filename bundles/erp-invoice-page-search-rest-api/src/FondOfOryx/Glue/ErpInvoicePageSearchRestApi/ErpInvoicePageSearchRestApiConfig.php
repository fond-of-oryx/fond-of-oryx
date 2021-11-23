<?php

namespace FondOfOryx\Glue\ErpInvoicePageSearchRestApi;

use Spryker\Glue\Kernel\AbstractBundleConfig;

class ErpInvoicePageSearchRestApiConfig extends AbstractBundleConfig
{
    /**
     * @var string
     */
    public const RESOURCE_ERP_INVOICES = 'erp-invoices';

    /**
     * @var string
     */
    public const RESOURCE_ERP_INVOICE = 'erp-invoice';

    /**
     * @var string
     */
    public const RESOURCE_COMPANY_BUSINESS_UNIT = 'company-business-unit';

    /**
     * @var string
     */
    public const RESOURCE_ERP_INVOICE_PAGE_SEARCH_REST_API = 'erp-invoice-page-search';

    /**
     * @var string
     */
    public const CONTROLLER_ERP_INVOICE_PAGE_SEARCH_REST_API = 'erp-invoice-page-search-resource';

    /**
     * @var string
     */
    public const ACTION_ERP_INVOICE_PAGE_SEARCH_REST_API_POST = 'post';

    /**
     * @var string
     */
    public const ACTION_ERP_INVOICE_PAGE_SEARCH_REST_API_GET = 'get';

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
