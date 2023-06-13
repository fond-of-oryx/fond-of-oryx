<?php

namespace FondOfOryx\Shared\CompanyTypeProductListSearchRestApi;

interface CompanyTypeProductListSearchRestApiConstants
{
    /**
     * @var string
     */
    public const FILTER_FIELD_TYPE_FOREIGN_CUSTOMER_REFERENCE = 'foreignCustomerReference';

    /**
     * @var string
     */
    public const FILTER_FIELD_TYPE_ID_CUSTOMER = 'idCustomer';

    /**
     * @var string
     */
    public const PARAMETER_NAME_CUSTOMER_ID = 'customer-id';

    /**
     * @var string
     */
    public const COMPANY_TYPE_NAME_FOR_MANUFACTURER = 'FOND_OF_ORYX:COMPANY_TYPE_PRODUCT_LIST_SEARCH_REST_API:COMPANY_TYPE_NAME_FOR_MANUFACTURER';

    /**
     * @var string
     */
    public const COMPANY_TYPE_NAME_FOR_MANUFACTURER_DEFAULT = 'manufacturer';
}
