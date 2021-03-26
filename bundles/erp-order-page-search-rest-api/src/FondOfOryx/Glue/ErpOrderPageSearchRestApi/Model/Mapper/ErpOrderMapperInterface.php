<?php

declare(strict_types = 1);

namespace FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Mapper;

use Generated\Shared\Transfer\RestErpOrderPageSearchCollectionResponseTransfer;

interface ErpOrderMapperInterface
{
    /**
     * @param array $searchResults
     *
     * @return \Generated\Shared\Transfer\RestErpOrderPageSearchCollectionResponseTransfer
     */
    public function mapErpOrderResource(
        array $searchResults
    ): RestErpOrderPageSearchCollectionResponseTransfer;
}
