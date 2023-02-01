<?php

namespace FondOfOryx\Zed\CustomerProductListApi\Dependency\Facade;

use Generated\Shared\Transfer\ApiItemTransfer;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;

interface CustomerProductListApiToApiFacadeInterface
{
    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer|null $transfer
     * @param string|null $id
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function createApiItem(?AbstractTransfer $transfer = null, ?string $id = null): ApiItemTransfer;
}
