<?php

namespace FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper;

use FondOfOryx\Glue\CartSearchRestApi\CartSearchRestApiConfig;
use Generated\Shared\Transfer\QuoteListTransfer;
use Generated\Shared\Transfer\RestCartSearchSortTransfer;

class RestCartSearchSortMapper implements RestCartSearchSortMapperInterface
{
    /**
     * @var string
     */
    protected const PATTERN_ORDER_BY = '/^([a-z_]+)::(asc|desc)/';

    /**
     * @var \FondOfOryx\Glue\CartSearchRestApi\CartSearchRestApiConfig
     */
    protected $config;

    /**
     * @param \FondOfOryx\Glue\CartSearchRestApi\CartSearchRestApiConfig $config
     */
    public function __construct(CartSearchRestApiConfig $config)
    {
        $this->config = $config;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteListTransfer $quoteListTransfer
     *
     * @return \Generated\Shared\Transfer\RestCartSearchSortTransfer
     */
    public function fromQuoteList(QuoteListTransfer $quoteListTransfer): RestCartSearchSortTransfer
    {
        $restCartSearchSortTransfer = (new RestCartSearchSortTransfer())
            ->setSortParamNames($this->config->getSortParamNames())
            ->setSortParamLocalizedNames($this->config->getSortParamLocalizedNames());

        $sort = null;

        foreach ($quoteListTransfer->getFilterFields() as $filterFieldTransfer) {
            if ($filterFieldTransfer->getType() !== 'orderBy') {
                continue;
            }

            $sort = $filterFieldTransfer->getValue();
        }

        if ($sort === null) {
            return $restCartSearchSortTransfer;
        }

        $sortFields = $this->config->getSortFields();
        $sortField = preg_replace(static::PATTERN_ORDER_BY, '$1', $sort);

        if (!in_array($sortField, $sortFields, true)) {
            return $restCartSearchSortTransfer;
        }

        $sortDirection = preg_replace(static::PATTERN_ORDER_BY, '$2', $sort);

        return $restCartSearchSortTransfer->setCurrentSortParam(sprintf('%s_%s', $sortField, $sortDirection))
            ->setCurrentSortOrder($sortDirection);
    }
}
