<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitApi\Dependency\QueryContainer;

use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;

interface CompanyBusinessUnitApiToApiQueryContainerInterface
{
    /**
     * @param array $data
     *
     * @return \Generated\Shared\Transfer\ApiCollectionTransfer
     */
    public function createApiCollection(array $data): ApiCollectionTransfer;

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer|array $data
     * @param int|null $id
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function createApiItem($data, ?int $id = null): ApiItemTransfer;
}
