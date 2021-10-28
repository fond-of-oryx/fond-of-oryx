<?php

namespace FondOfOryx\Shared\CompanyBusinessUnitSearchRestApi;

interface CompanyBusinessUnitSearchRestApiConstants
{
    /**
     * @var string
     */
    public const VALID_ITEMS_PER_PAGE_OPTIONS = 'FOND_OF_ORYX:COMPANY_BUSINESS_UNIT_REST_API:VALID_ITEMS_PER_PAGE_OPTIONS';
    /**
     * @var array
     */
    public const VALID_ITEMS_PER_PAGE_OPTIONS_DEFAULT = [12, 24, 36];

    /**
     * @var string
     */
    public const ITEMS_PER_PAGE = 'FOND_OF_ORYX:COMPANY_BUSINESS_UNIT_REST_API:ITEMS_PER_PAGE';
    /**
     * @var int
     */
    public const ITEMS_PER_PAGE_DEFAULT = 12;

    /**
     * @var string
     */
    public const SORT_FIELDS = 'FOND_OF_ORYX:COMPANY_BUSINESS_UNIT_REST_API:SORT_FIELDS';
    /**
     * @var array
     */
    public const SORT_FIELDS_DEFAULT = ['name'];

    /**
     * @var string
     */
    public const FULLTEXT_SEARCH_FIELDS = 'FOND_OF_ORYX:COMPANY_BUSINESS_UNIT_REST_API:FULLTEXT_SEARCH_FIELDS';
    /**
     * @var array
     */
    public const FULLTEXT_SEARCH_FIELDS_DEFAULT = [];
}
