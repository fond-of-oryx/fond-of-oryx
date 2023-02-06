<?php

namespace FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Mapper;

use Generated\Shared\Transfer\RestErpInvoicePageSearchPaginationTransfer;

interface RestErpInvoicePageSearchPaginationMapperInterface
{
    /**
     * @param array $searchResult
     *
     * @return \Generated\Shared\Transfer\RestErpInvoicePageSearchPaginationTransfer|null
     */
    public function fromSearchResult(array $searchResult): ?RestErpInvoicePageSearchPaginationTransfer;
}
