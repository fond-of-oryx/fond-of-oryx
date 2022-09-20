<?php

namespace FondOfOryx\Glue\ProductListSearchRestApi\Processor\Mapper;

use Generated\Shared\Transfer\PaginationTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class PaginationMapper implements PaginationMapperInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Generated\Shared\Transfer\PaginationTransfer
     */
    public function fromRestRequest(RestRequestInterface $restRequest): PaginationTransfer
    {
        $paginationTransfer = new PaginationTransfer();
        $page = $restRequest->getPage();

        if ($page === null) {
            return $paginationTransfer;
        }

        return $paginationTransfer->setMaxPerPage($page->getLimit())
            ->setPage(($page->getOffset() / $page->getLimit()) + 1);
    }
}
