<?php

namespace FondOfOryx\Zed\ThirtyFiveUpApi\Dependency\QueryContainer;

use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;

interface ThirtyFiveUpApiToApiQueryContainerInterface
{
    /**
     * @param array $data
     *
     * @return \Generated\Shared\Transfer\ApiCollectionTransfer
     */
    public function createApiCollection(array $data): ApiCollectionTransfer;

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $data
     * @param int|null $id
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function createApiItem(AbstractTransfer $data, ?int $id = null): ApiItemTransfer;
}
