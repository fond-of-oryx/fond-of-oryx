<?php

namespace FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Mapper;

use Generated\Shared\Transfer\RestErpInvoicePageSearchPaginationSortTransfer;

interface RestErpInvoicePageSearchPaginationSortMapperInterface
{
    /**
     * @param array $searchResult
     *
     * @return \Generated\Shared\Transfer\RestErpInvoicePageSearchPaginationSortTransfer|null
     */
    public function fromSearchResult(array $searchResult): ?RestErpInvoicePageSearchPaginationSortTransfer;
}
