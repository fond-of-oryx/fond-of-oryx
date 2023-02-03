<?php

declare(strict_types = 1);

namespace FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Mapper;

use Generated\Shared\Transfer\RestErpOrderPageSearchCollectionResponseTransfer;

interface RestErpOrderPageSearchCollectionResponseMapperInterface
{
    /**
     * @param array $searchResult
     *
     * @return \Generated\Shared\Transfer\RestErpOrderPageSearchCollectionResponseTransfer
     */
    public function fromSearchResult(
        array $searchResult
    ): RestErpOrderPageSearchCollectionResponseTransfer;
}
