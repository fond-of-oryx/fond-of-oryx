<?php

namespace FondOfOryx\Zed\CustomerProductListApi\Dependency\QueryContainer;

use Generated\Shared\Transfer\ApiItemTransfer;

interface CustomerProductListApiToApiQueryContainerInterface
{
    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer|array $data
     * @param int|null $id
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function createApiItem($data, ?int $id = null): ApiItemTransfer;
}
