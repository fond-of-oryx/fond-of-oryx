<?php

namespace FondOfOryx\Shared\RepresentativeCompanyUserTradeFairRestApi;

interface RepresentativeCompanyUserTradeFairRestApiConstants
{
    /**
     * @var int
     */
    public const HTTP_CODE_VALIDATION_ERRORS = 422;

    /**
     * @var string
     */
    public const HTTP_CODE_ADD_ERRORS = '1000';

    /**
     * @var string
     */
    public const HTTP_CODE_UPDATE_ERRORS = '2000';

    /**
     * @var string
     */
    public const HTTP_CODE_DELETE_ERRORS = '3000';

    /**
     * @var string
     */
    public const HTTP_MESSAGE_ADD_ERROR = 'Could not create trade fair representation!';

    /**
     * @var string
     */
    public const HTTP_MESSAGE_UPDATE_ERROR = 'Could not update trade fair representation!';

    /**
     * @var string
     */
    public const HTTP_MESSAGE_DELETE_ERROR = 'Could not delete trade fair representation!';

    /**
     * @var string
     */
    public const VALID_ITEMS_PER_PAGE_OPTIONS = 'FOND_OF_ORYX:REPRESENTATIVE_COMPANY_USER_TRADE_FAIR_REST_API:VALID_ITEMS_PER_PAGE_OPTIONS';

    /**
     * @var string
     */
    public const MAX_DURATION_FOR_REPRESENTATION = 'FOND_OF_ORYX:REPRESENTATIVE_COMPANY_USER_TRADE_FAIR_REST_API:MAX_DURATION_FOR_REPRESENTATION';

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
