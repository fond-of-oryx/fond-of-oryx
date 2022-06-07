<?php

namespace FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper;

use Generated\Shared\Transfer\QuoteListTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class QuoteListMapper implements QuoteListMapperInterface
{
    /**
     * @var \FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\FilterFieldsMapperInterface
     */
    protected $filterFieldsMapper;

    /**
     * @var \FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\PaginationMapperInterface
     */
    protected $paginationMapper;

    /**
     * @param \FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\FilterFieldsMapperInterface $filterFieldsMapper
     * @param \FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\PaginationMapperInterface $paginationMapper
     */
    public function __construct(
        FilterFieldsMapperInterface $filterFieldsMapper,
        PaginationMapperInterface $paginationMapper
    ) {
        $this->filterFieldsMapper = $filterFieldsMapper;
        $this->paginationMapper = $paginationMapper;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Generated\Shared\Transfer\QuoteListTransfer
     */
    public function fromRestRequest(RestRequestInterface $restRequest): QuoteListTransfer
    {
        return (new QuoteListTransfer())
            ->setFilterFields($this->filterFieldsMapper->fromRestRequest($restRequest))
            ->setPagination($this->paginationMapper->fromRestRequest($restRequest));
    }
}
