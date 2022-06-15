<?php

namespace FondOfOryx\Zed\CompanyProductListApi\Dependency\QueryContainer;

use Generated\Shared\Transfer\ApiItemTransfer;

interface CompanyProductListApiToApiQueryContainerInterface
{
    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer|array $data
     * @param int|null $id
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function createApiItem($data, ?int $id = null): ApiItemTransfer;
}
