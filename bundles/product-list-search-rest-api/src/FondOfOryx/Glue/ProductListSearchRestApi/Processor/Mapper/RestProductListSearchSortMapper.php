<?php

namespace FondOfOryx\Glue\ProductListSearchRestApi\Processor\Mapper;

use FondOfOryx\Glue\ProductListSearchRestApi\ProductListSearchRestApiConfig;
use Generated\Shared\Transfer\ProductListCollectionTransfer;
use Generated\Shared\Transfer\RestProductListSearchSortTransfer;

class RestProductListSearchSortMapper implements RestProductListSearchSortMapperInterface
{
    /**
     * @var string
     */
    protected const SORT_PATTERN = '/([a-z_]*)_(asc|desc)/';

    /**
     * @var \FondOfOryx\Glue\ProductListSearchRestApi\ProductListSearchRestApiConfig
     */
    protected $config;

    /**
     * @param \FondOfOryx\Glue\ProductListSearchRestApi\ProductListSearchRestApiConfig $config
     */
    public function __construct(ProductListSearchRestApiConfig $config)
    {
        $this->config = $config;
    }

    /**
     * @param \Generated\Shared\Transfer\ProductListCollectionTransfer $productListCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\RestProductListSearchSortTransfer
     */
    public function fromProductListCollection(
        ProductListCollectionTransfer $productListCollectionTransfer
    ): RestProductListSearchSortTransfer {
        $restProductListSearchSortTransfer = (new RestProductListSearchSortTransfer())
            ->setSortParamNames($this->config->getSortParamNames())
            ->setSortParamLocalizedNames($this->config->getSortParamLocalizedNames());

        $sort = $productListCollectionTransfer->getSort();

        if ($sort === null) {
            return $restProductListSearchSortTransfer;
        }

        $sortFields = $this->config->getSortFields();
        $sortField = preg_replace(static::SORT_PATTERN, '$1', $sort);

        if (!in_array($sortField, $sortFields, true)) {
            return $restProductListSearchSortTransfer;
        }

        $sortDirection = preg_replace(static::SORT_PATTERN, '$2', $sort);

        return $restProductListSearchSortTransfer->setCurrentSortParam($sort)
            ->setCurrentSortOrder($sortDirection);
    }
}
