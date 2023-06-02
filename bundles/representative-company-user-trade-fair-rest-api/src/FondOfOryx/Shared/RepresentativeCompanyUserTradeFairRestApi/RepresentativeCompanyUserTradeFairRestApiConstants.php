<?php

namespace FondOfOryx\Shared\RepresentativeCompanyUserTradeFairRestApi;

use FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApiPermission\Communication\Plugin\Permission\CanManageRepresentationOnTradeFairPermissionPlugin;

interface RepresentativeCompanyUserTradeFairRestApiConstants
{
    /**
     * @var string
     */
    public const PERMISSION_KEY = CanManageRepresentationOnTradeFairPermissionPlugin::KEY;

    /**
     * @var string
     */
    public const VALID_ITEMS_PER_PAGE_OPTIONS = 'FOND_OF_ORYX:REPRESENTATIVE_COMPANY_USER_TRADE_FAIR_REST_API:VALID_ITEMS_PER_PAGE_OPTIONS';

    /**
     * @var array
     */
    public const VALID_ITEMS_PER_PAGE_OPTIONS_DEFAULT = [12, 24, 36];

    /**
     * @var string
     */
    public const ITEMS_PER_PAGE = 'FOND_OF_ORYX:REPRESENTATIVE_COMPANY_USER_TRADE_FAIR_REST_API:ITEMS_PER_PAGE';

    /**
     * @var int
     */
    public const ITEMS_PER_PAGE_DEFAULT = 12;

    /**
     * @var string
     */
    public const SORT_FIELDS = 'FOND_OF_ORYX:REPRESENTATIVE_COMPANY_USER_TRADE_FAIR_REST_API:SORT_FIELDS';

    /**
     * @var array
     */
    public const SORT_FIELDS_DEFAULT = ['name'];

    /**
     * @var string
     */
    public const FULLTEXT_SEARCH_FIELDS = 'FOND_OF_ORYX:REPRESENTATIVE_COMPANY_USER_TRADE_FAIR_REST_API:FULLTEXT_SEARCH_FIELDS';

    /**
     * @var array
     */
    public const FULLTEXT_SEARCH_FIELDS_DEFAULT = ['name'];
}
