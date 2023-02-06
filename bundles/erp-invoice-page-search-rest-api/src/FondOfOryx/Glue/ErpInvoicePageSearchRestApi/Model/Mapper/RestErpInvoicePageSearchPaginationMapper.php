<?php

namespace FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Mapper;

use Generated\Shared\Transfer\PaginationSearchResultTransfer;
use Generated\Shared\Transfer\RestErpInvoicePageSearchPaginationTransfer;

class RestErpInvoicePageSearchPaginationMapper implements RestErpInvoicePageSearchPaginationMapperInterface
{
    /**
     * @param array $searchResult
     *
     * @return \Generated\Shared\Transfer\RestErpInvoicePageSearchPaginationTransfer|null
     */
    public function fromSearchResult(array $searchResult): ?RestErpInvoicePageSearchPaginationTransfer
    {
        if (!isset($searchResult['pagination']) || !($searchResult['pagination'] instanceof PaginationSearchResultTransfer)) {
            return null;
        }

        return (new RestErpInvoicePageSearchPaginationTransfer())
            ->fromArray($searchResult['pagination']->toArray(), true);
    }
}
