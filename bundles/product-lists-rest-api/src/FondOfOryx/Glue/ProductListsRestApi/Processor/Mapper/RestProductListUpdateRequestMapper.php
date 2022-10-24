<?php

namespace FondOfOryx\Glue\ProductListsRestApi\Processor\Mapper;

use FondOfOryx\Glue\ProductListsRestApi\Processor\Filter\IdProductListFilterInterface;
use Generated\Shared\Transfer\RestProductListUpdateRequestTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class RestProductListUpdateRequestMapper implements RestProductListUpdateRequestMapperInterface
{
    /**
     * @var \FondOfOryx\Glue\ProductListsRestApi\Processor\Filter\IdProductListFilterInterface
     */
    protected $idProductListFilter;

    /**
     * @param \FondOfOryx\Glue\ProductListsRestApi\Processor\Filter\IdProductListFilterInterface $idProductListFilter
     */
    public function __construct(IdProductListFilterInterface $idProductListFilter)
    {
        $this->idProductListFilter = $idProductListFilter;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Generated\Shared\Transfer\RestProductListUpdateRequestTransfer
     */
    public function fromRestRequest(
        RestRequestInterface $restRequest
    ): RestProductListUpdateRequestTransfer {
        return (new RestProductListUpdateRequestTransfer())
            ->setProductListId($this->idProductListFilter->filterFromRestRequest($restRequest));
    }
}
