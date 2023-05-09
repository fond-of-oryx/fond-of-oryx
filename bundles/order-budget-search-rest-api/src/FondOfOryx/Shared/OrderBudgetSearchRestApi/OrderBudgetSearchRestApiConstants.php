<?php

namespace FondOfOryx\Shared\OrderBudgetSearchRestApi;

interface OrderBudgetSearchRestApiConstants
{
    /**
     * @var string
     */
    public const VALID_ITEMS_PER_PAGE_OPTIONS = 'FOND_OF_ORYX:ORDER_BUDGET_SEARCH_REST_API:VALID_ITEMS_PER_PAGE_OPTIONS';

    /**
     * @var array<int>
     */
    public const VALID_ITEMS_PER_PAGE_OPTIONS_DEFAULT = [12, 24, 36];

    /**
     * @var string
     */
    public const ITEMS_PER_PAGE = 'FOND_OF_ORYX:ORDER_BUDGET_SEARCH_REST_API:ITEMS_PER_PAGE';

    /**
     * @var int
     */
    public const ITEMS_PER_PAGE_DEFAULT = 12;

    /**
     * @var string
     */
    public const DELIMITER_ORDER_BY = '::';

    /**
     * @var string
     */
    public const FILTER_FIELD_TYPE_ALL = 'all';

    /**
     * @var string
     */
    public const FILTER_FIELD_TYPE_MAPPING = 'FOND_OF_ORYX:ORDER_BUDGET_SEARCH_REST_API:FILTER_FIELD_TYPE_MAPPING';

    /**
     * @var array<string, string>
     */
    public const FILTER_FIELD_TYPE_MAPPING_DEFAULT = [];

    /**
     * @var string
     */
    public const FILTER_FIELD_TYPE_ORDER_BY = 'orderBy';

    /**
     * @var string
     */
    public const DELIMITER_SORT = '_';

    /**
     * @var string
     */
    public const SORT_FIELDS = 'FOND_OF_ORYX:ORDER_BUDGET_SEARCH_REST_API:SORT_FIELDS';

    /**
     * @var array<string>
     */
    public const SORT_FIELDS_DEFAULT = [];
}
