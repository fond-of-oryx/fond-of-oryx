<?php

declare(strict_types = 1);

namespace FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Mapper;

use Generated\Shared\Transfer\RestErpInvoicePageSearchCollectionResponseTransfer;

interface ErpInvoiceMapperInterface
{
    /**
     * @param array $searchResults
     *
     * @return \Generated\Shared\Transfer\RestErpInvoicePageSearchCollectionResponseTransfer
     */
    public function mapErpInvoiceResource(
        array $searchResults
    ): RestErpInvoicePageSearchCollectionResponseTransfer;
}
