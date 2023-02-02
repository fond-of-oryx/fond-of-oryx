<?php

declare(strict_types = 1);

namespace FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Mapper;

use Generated\Shared\Transfer\RestErpInvoicePageSearchCollectionResponseTransfer;

interface RestErpInvoicePageSearchCollectionResponseMapperInterface
{
    /**
     * @param array $searchResult
     *
     * @return \Generated\Shared\Transfer\RestErpInvoicePageSearchCollectionResponseTransfer
     */
    public function fromSearchResult(
        array $searchResult
    ): RestErpInvoicePageSearchCollectionResponseTransfer;
}
