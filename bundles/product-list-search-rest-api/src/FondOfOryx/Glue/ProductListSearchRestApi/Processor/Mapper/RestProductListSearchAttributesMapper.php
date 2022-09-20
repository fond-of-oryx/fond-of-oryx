<?php

namespace FondOfOryx\Glue\ProductListSearchRestApi\Processor\Mapper;

use Generated\Shared\Transfer\ProductListCollectionTransfer;
use Generated\Shared\Transfer\RestProductListSearchAttributesTransfer;

class RestProductListSearchAttributesMapper implements RestProductListSearchAttributesMapperInterface
{
    /**
     * @var \FondOfOryx\Glue\ProductListSearchRestApi\Processor\Mapper\RestProductListSearchResultItemMapperInterface
     */
    protected $restProductListSearchResultItemMapper;

    /**
     * @var \FondOfOryx\Glue\ProductListSearchRestApi\Processor\Mapper\RestProductListSearchSortMapperInterface
     */
    protected $restProductListSearchSortMapper;

    /**
     * @var \FondOfOryx\Glue\ProductListSearchRestApi\Processor\Mapper\RestProductListSearchPaginationMapperInterface
     */
    protected $restProductListSearchPaginationMapper;

    /**
     * @param \FondOfOryx\Glue\ProductListSearchRestApi\Processor\Mapper\RestProductListSearchResultItemMapperInterface $restProductListSearchResultItemMapper
     * @param \FondOfOryx\Glue\ProductListSearchRestApi\Processor\Mapper\RestProductListSearchSortMapperInterface $restProductListSearchSortMapper
     * @param \FondOfOryx\Glue\ProductListSearchRestApi\Processor\Mapper\RestProductListSearchPaginationMapperInterface $restProductListSearchPaginationMapper
     */
    public function __construct(
        RestProductListSearchResultItemMapperInterface $restProductListSearchResultItemMapper,
        RestProductListSearchSortMapperInterface $restProductListSearchSortMapper,
        RestProductListSearchPaginationMapperInterface $restProductListSearchPaginationMapper
    ) {
        $this->restProductListSearchResultItemMapper = $restProductListSearchResultItemMapper;
        $this->restProductListSearchSortMapper = $restProductListSearchSortMapper;
        $this->restProductListSearchPaginationMapper = $restProductListSearchPaginationMapper;
    }

    /**
     * @param \Generated\Shared\Transfer\ProductListCollectionTransfer $productListCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\RestProductListSearchAttributesTransfer
     */
    public function fromProductListCollection(
        ProductListCollectionTransfer $productListCollectionTransfer
    ): RestProductListSearchAttributesTransfer {
        return (new RestProductListSearchAttributesTransfer())->setProductList(
            $this->restProductListSearchResultItemMapper->fromProductListCollection($productListCollectionTransfer),
        )->setSort(
            $this->restProductListSearchSortMapper->fromProductListCollection($productListCollectionTransfer),
        )->setPagination(
            $this->restProductListSearchPaginationMapper->fromProductListCollection($productListCollectionTransfer),
        );
    }
}
