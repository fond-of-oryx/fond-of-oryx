<?php

namespace FondOfOryx\Shared\CompanyBusinessUnitAddressSearchRestApi;

interface CompanyBusinessUnitAddressSearchRestApiConstants
{
    /**
     * @var string
     */
    public const VALID_ITEMS_PER_PAGE_OPTIONS = 'FOND_OF_ORYX:COMPANY_BUSINESS_UNIT_ADDRESS_REST_API:VALID_ITEMS_PER_PAGE_OPTIONS';

    /**
     * @var array
     */
    public const VALID_ITEMS_PER_PAGE_OPTIONS_DEFAULT = [12, 24, 36];

    /**
     * @var string
     */
    public const ITEMS_PER_PAGE = 'FOND_OF_ORYX:COMPANY_BUSINESS_UNIT_ADDRESS_REST_API:ITEMS_PER_PAGE';

    /**
     * @var int
     */
    public const ITEMS_PER_PAGE_DEFAULT = 12;

    /**
     * @var string
     */
    public const SORT_FIELDS = 'FOND_OF_ORYX:COMPANY_BUSINESS_UNIT_ADDRESS_REST_API:SORT_FIELDS';

    /**
     * @var array
     */
    public const SORT_FIELDS_DEFAULT = ['address1', 'address2'];

    /**
     * @var string
     */
    public const FULLTEXT_SEARCH_FIELDS = 'FOND_OF_ORYX:COMPANY_BUSINESS_UNIT_ADDRESS_REST_API:FULLTEXT_SEARCH_FIELDS';

    /**
     * @var array
     */
    public const FULLTEXT_SEARCH_FIELDS_DEFAULT = ['address1', 'address2', 'address3', 'city', 'zip_code'];

    /**
     * @var string
     */
    public const FILTER_FIELD_TYPE_COMPANY_UUID = 'companyUuid';

    /**
     * @var string
     */
    public const FILTER_FIELD_TYPE_COMPANY_BUSINESS_UNIT_UUID = 'companyBusinessUnitUuid';

    /**
     * @var string
     */
    public const FILTER_FIELD_TYPE_COMPANY_BUSINESS_UNIT_ADDRESS_UUID = 'companyBusinessUnitAddressUuid';

    /**
     * @var string
     */
    public const FILTER_FIELD_TYPE_SORT = 'sort';

    /**
     * @var string
     */
    public const FILTER_FIELD_TYPE_DEFAULT_BILLING = 'defaultBilling';

    /**
     * @var string
     */
    public const FILTER_FIELD_TYPE_DEFAULT_SHIPPING = 'defaultShipping';

    /**
     * @var string
     */
    public const FILTER_FIELD_TYPE_FULL_TEXT = 'fullText';
}
