<?php

namespace FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Mapper;

use Generated\Shared\Transfer\RestErpInvoicePageSearchPaginationSortTransfer;
use Generated\Shared\Transfer\SortSearchResultTransfer;

class RestErpInvoicePageSearchPaginationSortMapper implements RestErpInvoicePageSearchPaginationSortMapperInterface
{
    /**
     * @param array $searchResult
     *
     * @return \Generated\Shared\Transfer\RestErpInvoicePageSearchPaginationSortTransfer|null
     */
    public function fromSearchResult(array $searchResult): ?RestErpInvoicePageSearchPaginationSortTransfer
    {
        if (!isset($searchResult['sort']) || !($searchResult['sort'] instanceof SortSearchResultTransfer)) {
            return null;
        }

        return (new RestErpInvoicePageSearchPaginationSortTransfer())
            ->fromArray($searchResult['sort']->toArray(), true);
    }
}
