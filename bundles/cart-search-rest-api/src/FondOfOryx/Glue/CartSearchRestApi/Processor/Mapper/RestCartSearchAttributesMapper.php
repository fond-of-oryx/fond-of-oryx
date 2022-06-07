<?php

namespace FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper;

use Generated\Shared\Transfer\QuoteListTransfer;
use Generated\Shared\Transfer\RestCartSearchAttributesTransfer;

class RestCartSearchAttributesMapper implements RestCartSearchAttributesMapperInterface
{
    /**
     * @var \FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\RestCartsAttributesMapperInterface
     */
    protected $restCartsAttributesMapper;

    /**
     * @var \FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\RestCartSearchSortMapperInterface
     */
    protected $restCartSearchSortMapper;

    /**
     * @var \FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\RestCartSearchPaginationMapperInterface
     */
    protected $restCartSearchPaginationMapper;

    /**
     * @param \FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\RestCartsAttributesMapperInterface $restCartsAttributesMapper
     * @param \FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\RestCartSearchSortMapperInterface $restCartSearchSortMapper
     * @param \FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\RestCartSearchPaginationMapperInterface $restCartSearchPaginationMapper
     */
    public function __construct(
        RestCartsAttributesMapperInterface $restCartsAttributesMapper,
        RestCartSearchSortMapperInterface $restCartSearchSortMapper,
        RestCartSearchPaginationMapperInterface $restCartSearchPaginationMapper
    ) {
        $this->restCartSearchSortMapper = $restCartSearchSortMapper;
        $this->restCartSearchPaginationMapper = $restCartSearchPaginationMapper;
        $this->restCartsAttributesMapper = $restCartsAttributesMapper;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteListTransfer $quoteListTransfer
     *
     * @return \Generated\Shared\Transfer\RestCartSearchAttributesTransfer
     */
    public function fromQuoteList(QuoteListTransfer $quoteListTransfer): RestCartSearchAttributesTransfer
    {
        return (new RestCartSearchAttributesTransfer())->setCarts(
            $this->restCartsAttributesMapper->fromQuoteList($quoteListTransfer),
        )->setSort(
            $this->restCartSearchSortMapper->fromQuoteList($quoteListTransfer),
        )->setPagination(
            $this->restCartSearchPaginationMapper->fromQuoteList($quoteListTransfer),
        );
    }
}
