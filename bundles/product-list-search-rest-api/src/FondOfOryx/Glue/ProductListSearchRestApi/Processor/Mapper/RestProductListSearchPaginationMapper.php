<?php

namespace FondOfOryx\Glue\ProductListSearchRestApi\Processor\Mapper;

use FondOfOryx\Glue\ProductListSearchRestApi\ProductListSearchRestApiConfig;
use Generated\Shared\Transfer\ProductListCollectionTransfer;
use Generated\Shared\Transfer\RestProductListSearchPaginationConfigTransfer;
use Generated\Shared\Transfer\RestProductListSearchPaginationTransfer;

class RestProductListSearchPaginationMapper implements RestProductListSearchPaginationMapperInterface
{
    /**
     * @var string
     */
    public const PARAMETER_NAME_PAGE = 'page';

    /**
     * @var string
     */
    public const PARAMETER_NAME_ITEMS_PER_PAGE = 'ipp';

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
     * @return \Generated\Shared\Transfer\RestProductListSearchPaginationTransfer
     */
    public function fromProductListCollection(
        ProductListCollectionTransfer $productListCollectionTransfer
    ): RestProductListSearchPaginationTransfer {
        $restProductListSearchPaginationTransfer = new RestproductListSearchPaginationTransfer();

        $paginationTransfer = $productListCollectionTransfer->getPagination();

        if ($paginationTransfer === null) {
            return $restProductListSearchPaginationTransfer;
        }

        return $restProductListSearchPaginationTransfer->setCurrentPage($paginationTransfer->getPage())
            ->setMaxPage($paginationTransfer->getLastPage())
            ->setCurrentItemsPerPage($paginationTransfer->getMaxPerPage())
            ->setNumFound($paginationTransfer->getNbResults())
            ->setConfig($this->createRestProductListSearchPaginationConfig());
    }

    /**
     * @return \Generated\Shared\Transfer\RestProductListSearchPaginationConfigTransfer
     */
    protected function createRestProductListSearchPaginationConfig(): RestProductListSearchPaginationConfigTransfer
    {
        return (new RestProductListSearchPaginationConfigTransfer())
            ->setDefaultItemsPerPage($this->config->getItemsPerPage())
            ->setItemsPerPageParameterName(static::PARAMETER_NAME_ITEMS_PER_PAGE)
            ->setParameterName(static::PARAMETER_NAME_PAGE)
            ->setValidItemsPerPageOptions($this->config->getValidItemsPerPageOptions());
    }
}
